<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function store(Request $request, Event $event)
    {
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'rsvp_status' => 'required|string|in:pending,attending,declined',
            'plus_ones' => 'nullable|integer|min:0',
        ]);

        $guest = new Guest($validated);
        $guest->event_id = $event->id;
        $guest->save();

        return redirect()->route('events.show', $event)->with('success', 'Guest added.');
    }

    public function update(Request $request, Guest $guest)
    {
        $event = Event::findOrFail($guest->event_id);
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'rsvp_status' => 'required|string|in:pending,attending,declined',
            'plus_ones' => 'nullable|integer|min:0',
        ]);

        $guest->update($validated);

        return redirect()->route('events.show', $event)->with('success', 'Guest updated.');
    }

    public function destroy(Guest $guest)
    {
        $event = Event::findOrFail($guest->event_id);
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }

        $guest->delete();

        return redirect()->route('events.show', $event)->with('success', 'Guest removed.');
    }
}
