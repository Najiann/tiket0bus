<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Bus;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with (['bus', 'destination'])
            ->get();
        return view('bookings.mybookings', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $busId = $request->query('bus_id');
        $bus = Bus::with('destination')->find($busId); // kalau bus punya relasi destination
        $buses = Bus::all();
        $destinations = Destination::all();

        return view('bookings.create', compact('bus', 'buses', 'destinations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // simpen yang new
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'destination_id' => 'required|exists:destinations,id',
            'tanggal_keberangkatan' => 'required|date',
            'jumlah_tiket' => 'required|integer|min:1',
        ]);

        // get harga euy
        $bus = Bus::findOrFail($request->bus_id);
        $totalHarga = $bus->harga * $request->jumlah_tiket;

        // kode booking generate random
        $kodeBooking = 'BOOK-' . date('Ymd') . '-' . strtoupper(uniqid());


        Booking::create([
            'kode_booking' => $kodeBooking,
            'user_id' => Auth::id(),
            'bus_id' => $request->bus_id,
            'destination_id' => $request->destination_id,
            'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
            'jumlah_tiket' => $request->jumlah_tiket,
            'total_harga' => $totalHarga,
            'status' => 'pending'
        ]);

        return redirect()->route('checkout', ['kode_booking' => $kodeBooking])
                 ->with('success', 'Tiket berhasil dipesan!');
    }

    public function myBookings()
    {
        // ambil booking yang cuma punya user login ini
        $bookings = Booking::where('user_id', Auth::id())
            ->with(['bus', 'destination'])
            ->get();

        // cek dulu muncul gak
        //dd($bookings);

        // arahkan ke view yang kamu udah punya
        return view('bookings.mybookings', compact('bookings'));
    }

    public function payNow($kode_booking) 
    {
        $booking = Booking::where('kode_booking', $kode_booking)->firstOrFail();
        
        if ($booking->status === 'paid') {
            return redirect('/mybookings')->with('info', 'Tiket ini sudah dibayar sebelumnya.');
        }
    
        $booking->status = 'paid';
        $booking->save();
    
        return redirect('/mybookings')->with('success', 'Pembayaran berhasil! ✅');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $booking = Booking::with(['bus', 'destination'])->findOrFail($id);
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // ubah status booking
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,paid',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $request->status]);

        return redirect()->route('bookings.index')->with('success', 'Booking status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        if ($booking->user_id != Auth::id()) {
            return redirect()->route('bookings.index')->with('error', 'Unauthorized action.');
        }

        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking cancelled successfully.');
    }
}