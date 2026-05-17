@extends('layouts.app')

@section('header', 'Edit Event')

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <form action="{{ route('events.update', $event) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="grid grid-cols-2 mb-3">
            <div class="form-group mb-0">
                <label class="form-label">Event Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $event->title) }}" required>
            </div>
            <div class="form-group mb-0">
                <label class="form-label">Event Date</label>
                <input type="date" name="date" class="form-control" value="{{ old('date', substr($event->date, 0, 10)) }}" required>
            </div>
        </div>
        
        <div class="grid grid-cols-2 mb-3">
            <div class="form-group mb-0">
                <label class="form-label">Budget ($)</label>
                <input type="number" step="0.01" name="budget" class="form-control" value="{{ old('budget', $event->budget) }}">
            </div>
            <div class="form-group mb-0">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control" value="{{ old('location', $event->location) }}">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Description / Notes</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="d-flex justify-between mt-4">
            <a href="{{ route('events.show', $event) }}" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>
@endsection
