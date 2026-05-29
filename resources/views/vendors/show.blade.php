@extends('layouts.app')

@section('header', 'Vendor Details')

@section('content')
<div style="display: flex; gap: 2rem; flex-wrap: wrap;">
    <!-- Vendor Info -->
    <div class="card" style="flex: 2; min-width: 300px;">
        <img src="{{ $vendor->image_url ?? 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80&w=800' }}" alt="{{ $vendor->name }}" style="width: 100%; height: 300px; object-fit: cover; border-radius: var(--border-radius); margin-bottom: 1.5rem;">
        
        <div class="d-flex justify-between align-center mb-1">
            <span class="badge" style="background: var(--primary-light); color: var(--primary-dark);">{{ $vendor->type }}</span>
            <span style="font-weight: 600; font-size: 1.2rem;">⭐ {{ $vendor->rating ?? 'New' }}</span>
        </div>
        
        <h2 style="margin-bottom: 0.5rem; color: var(--primary-color);">{{ $vendor->name }}</h2>
        
        <p class="text-muted" style="font-size: 1.1rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
            <span>📍 {{ $vendor->location }}</span>
            <span>•</span>
            <span style="color: var(--primary-dark); font-weight: 600;">💰 ${{ number_format($vendor->price) }} / event</span>
        </p>
        
        <div style="margin-bottom: 1.5rem;">
            <h3 style="margin-bottom: 0.5rem;">About</h3>
            <p style="line-height: 1.6; font-size: 1.05rem;">{{ $vendor->description }}</p>
        </div>
        
        <a href="{{ route('vendors.index') }}" class="btn btn-outline">Back to Directory</a>
    </div>

    <!-- Booking Form -->
    <div class="card" style="flex: 1; min-width: 300px; height: fit-content; position: sticky; top: 2rem;">
        <h3 style="margin-bottom: 1.5rem;">Book this Vendor</h3>
        
        <form action="{{ route('vendors.book', $vendor) }}" method="POST">
            @csrf
            
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label class="form-label" for="event_id">Select Event</label>
                <select name="event_id" id="event_id" class="form-control" required>
                    <option value="">-- Choose your event --</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->title }} ({{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }})</option>
                    @endforeach
                </select>
                @if($events->isEmpty())
                    <small style="color: #e74c3c; display: block; margin-top: 0.5rem;">You need to create an event first.</small>
                @endif
            </div>

            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label class="form-label" for="booking_date">Booking Date</label>
                <input type="date" name="booking_date" id="booking_date" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;" {{ $events->isEmpty() ? 'disabled' : '' }}>
                Book Vendor
            </button>
        </form>
    </div>
</div>
@endsection
