<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', Auth::id())->orderBy('date', 'asc')->get();
        return view('dashboard', compact('events'));
    }
}
