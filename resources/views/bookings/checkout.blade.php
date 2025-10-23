@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h2 class="mb-3 fw-bold text-danger">Invoice Pembayaran</h2>
    <p>Kode Booking: <strong>{{ $booking->kode_booking }}</strong></p>
    <p>Total Pembayaran: 
        <strong>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</strong>
    </p>

    <div class="alert alert-info mt-4">
        Silakan klik tombol di bawah untuk menyelesaikan pembayaran.
    </div>

    <form action="{{ route('pay.now', $booking->kode_booking) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success mt-3 px-5 py-2">
            💳 Bayar Sekarang
        </button>
    </form>
</div>
@endsection
