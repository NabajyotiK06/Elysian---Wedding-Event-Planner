<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\Guest;

class EventController extends Controller
{
    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'budget' => 'nullable|numeric',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
        ]);

        $event = new Event($validated);
        $event->user_id = Auth::id();
        $event->save();

        return redirect()->route('dashboard')->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }
        
        $event->load('vendors');
        $guests = Guest::where('event_id', $event->id)->get();
        return view('events.show', compact('event', 'guests'));
    }

    public function edit(Event $event)
    {
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }

        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'budget' => 'nullable|numeric',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
        ]);

        $event->update($validated);

        return redirect()->route('events.show', $event)->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }

        $event->delete();

        return redirect()->route('dashboard')->with('success', 'Event deleted successfully.');
    }

    public function addCustomVendor(Request $request, Event $event)
    {
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'type'         => 'required|string|max:100',
            'price'        => 'required|numeric|min:0',
            'booking_date' => 'required|date',
            'description'  => 'nullable|string|max:500',
        ]);

        $vendor = \App\Models\Vendor::create([
            'name'        => $validated['name'],
            'type'        => $validated['type'],
            'price'       => $validated['price'],
            'description' => $validated['description'] ?? null,
            'is_custom'   => true,
            'user_id'     => Auth::id(),
        ]);

        $event->vendors()->attach($vendor->id, [
            'booking_date' => $validated['booking_date'],
            'status'       => 'Booked',
        ]);

        return redirect()->route('events.show', $event)->with('success', 'Custom vendor added successfully!');
    }

    public function removeVendor(Event $event, \App\Models\Vendor $vendor)
    {
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }

        $event->vendors()->detach($vendor->id);

        // Delete the vendor record entirely if it's a custom one belonging to this user
        if ($vendor->is_custom && $vendor->user_id === Auth::id()) {
            $vendor->delete();
        }

        return redirect()->route('events.show', $event)->with('success', 'Vendor removed from event.');
    }
}
