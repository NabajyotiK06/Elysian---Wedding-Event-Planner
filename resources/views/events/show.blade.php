@extends('layouts.app')

@section('header', 'Event Details: ' . $event->title)

@section('content')
<div class="d-flex justify-between align-center mb-4">
    <a href="{{ route('dashboard') }}" class="btn btn-outline">&larr; Back to Dashboard</a>
    <a href="{{ route('events.edit', $event) }}" class="btn btn-secondary">Edit Event</a>
</div>

<div class="grid grid-cols-4 mb-4">
    <div class="card stat-card" style="grid-column: span 2;">
        <div>
            <h3 style="margin-bottom: 0.5rem; color: var(--primary-dark);">{{ $event->title }}</h3>
            <p class="text-muted mb-2">
                <strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date)->format('l, F j, Y') }}<br>
                <strong>Location:</strong> {{ $event->location ?? 'Not specified' }}<br>
                <strong>Budget:</strong> ${{ number_format($event->budget) }}
            </p>
            <p>{{ $event->description }}</p>
        </div>
    </div>
    <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; gap: 0.5rem;">
        <h2 style="font-size: 3.5rem; color: var(--primary-color); margin: 0; line-height: 1;">{{ count($guests) }}</h2>
        <p class="text-muted" style="margin: 0; font-size: 1.1rem; font-weight: 500;">Total Guests Invited</p>
        <div class="d-flex gap-2 mt-2" style="justify-content: center;">
            <span class="badge badge-attending" style="padding: 0.5rem 1rem;">{{ $guests->where('rsvp_status', 'attending')->count() }} Attending</span>
            <span class="badge badge-pending" style="padding: 0.5rem 1rem;">{{ $guests->where('rsvp_status', 'pending')->count() }} Pending</span>
        </div>
    </div>
    <div class="card" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; gap: 0.5rem;">
        <h2 style="font-size: 2.5rem; color: var(--primary-color); margin: 0; line-height: 1;">${{ number_format($event->budget) }}</h2>
        <p class="text-muted" style="margin: 0; font-size: 1.1rem; font-weight: 500;">Total Budget</p>
        <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-top: 1rem; width: 100%; max-width: 200px;">
            <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem;">
                <span class="text-muted">Spent:</span>
                <span style="color: #e74c3c; font-weight: 600;">${{ number_format($event->total_vendor_cost) }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; padding-top: 0.25rem;">
                <span class="text-muted">Remaining:</span>
                <span style="color: #2ecc71; font-weight: 600;">${{ number_format($event->remaining_budget) }}</span>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="d-flex justify-between align-center mb-3">
        <h3>Guest List</h3>
        <button class="btn btn-primary" onclick="document.getElementById('addGuestForm').style.display = 'block'">+ Add Guest</button>
    </div>

    <div id="addGuestForm" style="display: none; background: var(--primary-light); padding: 1.5rem; border-radius: var(--border-radius); margin-bottom: 1.5rem;">
        <h4>Add New Guest</h4>
        <form action="{{ route('guests.store', $event) }}" method="POST">
            @csrf
            <div class="grid grid-cols-4 mb-2">
                <div class="form-group mb-0">
                    <input type="text" name="name" class="form-control" placeholder="Guest Name" required>
                </div>
                <div class="form-group mb-0">
                    <input type="email" name="email" class="form-control" placeholder="Email Address">
                </div>
                <div class="form-group mb-0">
                    <select name="rsvp_status" class="form-control" required>
                        <option value="pending">Pending</option>
                        <option value="attending">Attending</option>
                        <option value="declined">Declined</option>
                    </select>
                </div>
                <div class="form-group mb-0">
                    <input type="number" name="plus_ones" class="form-control" placeholder="+1s (0)" min="0" value="0">
                </div>
            </div>
            <div class="d-flex gap-2 justify-end">
                <button type="button" class="btn btn-outline" onclick="document.getElementById('addGuestForm').style.display = 'none'">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Guest</button>
            </div>
        </form>
    </div>

    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>RSVP Status</th>
                    <th>+1s</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($guests as $guest)
                    <tr>
                        <td>{{ $guest->name }}</td>
                        <td>{{ $guest->email ?? '-' }}</td>
                        <td>
                            <span class="badge badge-{{ $guest->rsvp_status }}">
                                {{ ucfirst($guest->rsvp_status) }}
                            </span>
                        </td>
                        <td>{{ $guest->plus_ones ?? 0 }}</td>
                        <td>
                            <form action="{{ route('guests.destroy', $guest) }}" method="POST" onsubmit="return confirm('Remove this guest?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 0.2rem 0.5rem; font-size: 0.8rem;">Remove</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center" style="padding: 1.5rem;">No guests added yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card mb-4">
    <div class="d-flex justify-between align-center mb-3">
        <h3>Booked Vendors</h3>
        <a href="{{ route('vendors.index') }}" class="btn btn-outline">Browse Vendors</a>
    </div>

    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Vendor Name</th>
                    <th>Type</th>
                    <th>Booking Date</th>
                    <th>Cost</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($event->vendors as $vendor)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="{{ $vendor->image_url ?? 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80&w=800' }}" alt="{{ $vendor->name }}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                                <strong>{{ $vendor->name }}</strong>
                            </div>
                        </td>
                        <td>{{ $vendor->type }}</td>
                        <td>{{ \Carbon\Carbon::parse($vendor->pivot->booking_date)->format('M d, Y') }}</td>
                        <td style="font-weight: 600;">${{ number_format($vendor->price) }}</td>
                        <td>
                            <span class="badge" style="background: var(--primary-light); color: var(--primary-dark);">
                                {{ $vendor->pivot->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center" style="padding: 1.5rem;">No vendors booked yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
