<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $query = Vendor::query();

        if ($request->filled('type')) {
            $query->where('type', 'like', '%' . $request->type . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->max_price);
        }

        $vendors = $query->get();

        return view('vendors.index', compact('vendors'));
    }

    public function show(Vendor $vendor)
    {
        $events = auth()->user()->events()->orderBy('date')->get();
        return view('vendors.show', compact('vendor', 'events'));
    }

    public function book(Request $request, Vendor $vendor)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'booking_date' => 'required|date'
        ]);

        $event = auth()->user()->events()->findOrFail($request->event_id);
        
        $event->vendors()->attach($vendor->id, [
            'booking_date' => $request->booking_date,
            'status' => 'Booked'
        ]);

        return redirect()->route('vendors.show', $vendor)->with('success', 'Vendor successfully booked for your event!');
    }
}
