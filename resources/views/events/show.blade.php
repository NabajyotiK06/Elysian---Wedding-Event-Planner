@extends('layouts.app')

@section('header', 'Event Details: ' . $event->title)

@section('content')

{{-- Flash messages --}}
@if(session('success'))
<div class="alert alert-success" style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 1rem 1.5rem; border-radius: var(--border-radius); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
    <span style="font-size: 1.2rem;">✓</span> {{ session('success') }}
</div>
@endif
@if($errors->any())
<div class="alert alert-danger" style="background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 1rem 1.5rem; border-radius: var(--border-radius); margin-bottom: 1.5rem;">
    <ul style="margin: 0; padding-left: 1.25rem;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

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
        <div class="d-flex gap-2">
            <button class="btn btn-primary" id="toggleCustomVendorFormBtn" onclick="toggleCustomVendorForm()">+ Add Custom Vendor</button>
            <a href="{{ route('vendors.index') }}" class="btn btn-outline">Browse Listed Vendors</a>
        </div>
    </div>

    {{-- Custom Vendor Inline Form --}}
    <div id="customVendorForm" style="display: none; background: var(--primary-light); padding: 1.5rem; border-radius: var(--border-radius); margin-bottom: 1.5rem; border-left: 4px solid var(--primary-color);">
        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
            <span style="font-size: 1.5rem;">🧾</span>
            <div>
                <h4 style="margin: 0; color: var(--primary-dark);">Add Third-Party / Custom Vendor</h4>
                <p class="text-muted" style="margin: 0; font-size: 0.875rem;">Add a vendor that isn't listed on our platform — a personal contact, local business, or external service.</p>
            </div>
        </div>
        <form action="{{ route('events.add-custom-vendor', $event) }}" method="POST">
            @csrf
            <div class="grid grid-cols-4 mb-3" style="gap: 1rem;">
                <div class="form-group mb-0">
                    <label style="font-size: 0.8rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 0.4rem;">Vendor Name *</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Sharma Catering Co." required value="{{ old('name') }}">
                </div>
                <div class="form-group mb-0">
                    <label style="font-size: 0.8rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 0.4rem;">Vendor Type *</label>
                    <select name="type" class="form-control" required>
                        <option value="" disabled {{ old('type') ? '' : 'selected' }}>Select type…</option>
                        @foreach(['Caterer','Photographer','Videographer','Florist','Venue','DJ','Live Band','Decorator','Makeup Artist','Transportation','Jewellery','Invitation / Stationery','Other'] as $t)
                            <option value="{{ $t }}" {{ old('type') == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-0">
                    <label style="font-size: 0.8rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 0.4rem;">Cost (USD) *</label>
                    <input type="number" name="price" class="form-control" placeholder="e.g. 2500" min="0" step="0.01" required value="{{ old('price') }}">
                </div>
                <div class="form-group mb-0">
                    <label style="font-size: 0.8rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 0.4rem;">Booking Date *</label>
                    <input type="date" name="booking_date" class="form-control" required value="{{ old('booking_date', $event->date) }}">
                </div>
            </div>
            <div class="form-group mb-3">
                <label style="font-size: 0.8rem; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 0.4rem;">Notes / Description (optional)</label>
                <textarea name="description" class="form-control" rows="2" placeholder="Any notes about this vendor, contact details, etc.">{{ old('description') }}</textarea>
            </div>
            <div class="d-flex gap-2 justify-end">
                <button type="button" class="btn btn-outline" onclick="toggleCustomVendorForm()">Cancel</button>
                <button type="submit" class="btn btn-primary">✓ Add Vendor to Event</button>
            </div>
        </form>
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($event->vendors as $vendor)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                @if($vendor->is_custom)
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, var(--primary-light), var(--primary-color)); display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0;">🧾</div>
                                @else
                                    <img src="{{ $vendor->image_url ?? 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80&w=800' }}" alt="{{ $vendor->name }}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%; flex-shrink: 0;">
                                @endif
                                <div>
                                    <strong>{{ $vendor->name }}</strong>
                                    @if($vendor->is_custom)
                                        <span style="display: inline-block; margin-left: 0.4rem; background: #fff3cd; color: #856404; border: 1px solid #ffc107; font-size: 0.7rem; font-weight: 700; padding: 0.1rem 0.45rem; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px; vertical-align: middle;">Custom</span>
                                    @endif
                                    @if($vendor->description)
                                        <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 2px;">{{ Str::limit($vendor->description, 60) }}</div>
                                    @endif
                                </div>
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
                        <td>
                            <form action="{{ route('events.remove-vendor', [$event, $vendor]) }}" method="POST" onsubmit="return confirm('Remove {{ addslashes($vendor->name) }} from this event?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 0.2rem 0.6rem; font-size: 0.8rem;">Remove</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center" style="padding: 1.5rem;">No vendors booked yet. Browse our listed vendors or add a custom one above.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function toggleCustomVendorForm() {
    var form = document.getElementById('customVendorForm');
    var btn  = document.getElementById('toggleCustomVendorFormBtn');
    if (form.style.display === 'none') {
        form.style.display = 'block';
        form.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        btn.textContent = '✕ Cancel';
    } else {
        form.style.display = 'none';
        btn.textContent = '+ Add Custom Vendor';
    }
}

// Auto-open form if validation failed (old input present)
@if($errors->any() && old('name'))
    document.addEventListener('DOMContentLoaded', function() { toggleCustomVendorForm(); });
@endif
</script>
@endsection

