<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class CheckoutController extends Controller
{
    public function index($kode_booking)
    {
        $booking = Booking::where('kode_booking', $kode_booking)->firstOrFail();
        return view('bookings.checkout', compact('booking'));
    }

    //
    public function payNow($kode_booking)
    {
        $booking = Booking::where('kode_booking', $kode_booking)->firstOrFail();
        $booking->status = 'confirmed';
        $booking->save();

        return redirect('/mybookings')->with('success', 'Pembayaran berhasil! ✅');
    }
}
