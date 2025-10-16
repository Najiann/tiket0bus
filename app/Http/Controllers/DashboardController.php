<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['bus', 'destination'])
            ->where('user_id', Auth::id())
            ->get();

        return view('dashboard', compact('bookings'));
    }
}
