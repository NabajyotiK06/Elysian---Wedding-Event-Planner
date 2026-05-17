@extends('layouts.app')

@section('header', 'Create New Event')

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <form action="{{ route('events.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-2 mb-3">
            <div class="form-group mb-0">
                <label class="form-label">Event Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required placeholder="e.g. John & Jane Wedding">
            </div>
            <div class="form-group mb-0">
                <label class="form-label">Event Date</label>
                <input type="date" name="date" class="form-control" value="{{ old('date') }}" required>
            </div>
        </div>
        
        <div class="grid grid-cols-2 mb-3">
            <div class="form-group mb-0">
                <label class="form-label">Budget ($)</label>
                <input type="number" step="0.01" name="budget" class="form-control" value="{{ old('budget') }}" placeholder="e.g. 15000">
            </div>
            <div class="form-group mb-0">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control" value="{{ old('location') }}" placeholder="e.g. Grand Plaza Hotel">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Description / Notes</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Any special notes or details...">{{ old('description') }}</textarea>
        </div>

        <div class="d-flex justify-between mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">Create Event</button>
        </div>
    </form>
</div>
@endsection
