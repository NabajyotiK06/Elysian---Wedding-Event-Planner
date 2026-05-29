@extends('layouts.app')

@section('header', 'Vendor Directory')

@section('content')
<div class="filter-section">
    <form action="{{ route('vendors.index') }}" method="GET" style="display: flex; gap: 1rem; width: 100%; align-items: flex-end;">
        <div style="flex: 1;">
            <label class="form-label">Vendor Type</label>
            <select name="type" class="form-control">
                <option value="">All Types</option>
                <option value="Venue" {{ request('type') == 'Venue' ? 'selected' : '' }}>Venue</option>
                <option value="Catering" {{ request('type') == 'Catering' ? 'selected' : '' }}>Catering</option>
                <option value="Photography" {{ request('type') == 'Photography' ? 'selected' : '' }}>Photography</option>
                <option value="Florist" {{ request('type') == 'Florist' ? 'selected' : '' }}>Florist</option>
                <option value="Music" {{ request('type') == 'Music' ? 'selected' : '' }}>Music/DJ</option>
            </select>
        </div>
        <div style="flex: 1;">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control" value="{{ request('location') }}" placeholder="City or Region">
        </div>
        <div style="flex: 1;">
            <label class="form-label">Max Price ($)</label>
            <input type="number" name="max_price" class="form-control" value="{{ request('max_price') }}" placeholder="No limit">
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Filter Vendors</button>
            @if(request()->anyFilled(['type', 'location', 'max_price']))
                <a href="{{ route('vendors.index') }}" class="btn btn-outline" style="margin-left: 0.5rem;">Clear</a>
            @endif
        </div>
    </form>
</div>

<div class="grid grid-cols-3">
    @forelse($vendors as $vendor)
        <div class="card">
            <img src="{{ $vendor->image_url ?? 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&q=80&w=800' }}" alt="{{ $vendor->name }}" class="vendor-image">
            <div class="d-flex justify-between align-center mb-1">
                <span class="badge" style="background: var(--primary-light); color: var(--primary-dark);">{{ $vendor->type }}</span>
                <span style="font-weight: 600;">⭐ {{ $vendor->rating ?? 'New' }}</span>
            </div>
            <h3 style="margin-bottom: 0.5rem;">{{ $vendor->name }}</h3>
            <p class="text-muted" style="font-size: 0.9rem; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <span>📍 {{ $vendor->location }}</span>
                <span>•</span>
                <span>💰 ${{ number_format($vendor->price) }}</span>
            </p>
            <p style="font-size: 0.95rem; margin-bottom: 1.5rem; height: 3rem; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                {{ $vendor->description }}
            </p>
            <a href="{{ route('vendors.show', $vendor) }}" class="btn btn-outline" style="width: 100%; text-align: center; display: block; box-sizing: border-box;">Contact Vendor</a>
        </div>
    @empty
        <div style="grid-column: span 3; text-align: center; padding: 4rem; background: var(--surface-color); border-radius: var(--border-radius);">
            <h3 style="color: var(--secondary-color);">No vendors found.</h3>
            <p class="text-muted">Try adjusting your filters or search criteria.</p>
        </div>
    @endforelse
</div>
@endsection
