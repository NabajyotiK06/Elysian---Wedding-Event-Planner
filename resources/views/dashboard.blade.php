@extends('layouts.app')

@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-3 mb-4">
    <div class="card stat-card">
        <div class="stat-icon">📅</div>
        <div class="stat-details">
            <h3>{{ count($events) }}</h3>
            <p>Total Events</p>
        </div>
    </div>
    <div class="card stat-card">
        <div class="stat-icon">💰</div>
        <div class="stat-details">
            <h3>${{ number_format($events->sum('budget')) }}</h3>
            <p>Total Budget Managed</p>
        </div>
    </div>
    <div class="card stat-card">
        <div class="stat-icon">✨</div>
        <div class="stat-details">
            <h3>{{ $events->where('date', '>=', now()->toDateString())->count() }}</h3>
            <p>Upcoming Events</p>
        </div>
    </div>
</div>

<div class="d-flex justify-between align-center mb-3">
    <h3>Your Events</h3>
    <a href="{{ route('events.create') }}" class="btn btn-primary">+ Create New Event</a>
</div>

<div class="card" style="padding: 0; overflow: hidden;">
    <table class="table">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Date</th>
                <th>Location</th>
                <th>Budget</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $event)
                <tr>
                    <td><strong>{{ $event->title }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</td>
                    <td>{{ $event->location ?? 'TBD' }}</td>
                    <td>${{ number_format($event->budget) }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('events.show', $event) }}" class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.9rem;">View</a>
                            <a href="{{ route('events.edit', $event) }}" class="btn btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.9rem;">Edit</a>
                            <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 0.4rem 0.8rem; font-size: 0.9rem;">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 2rem;">
                        <p class="text-muted mb-2">You haven't created any events yet.</p>
                        <a href="{{ route('events.create') }}" class="btn btn-primary">Create Your First Event</a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
