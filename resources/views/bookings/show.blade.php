@extends('layouts.app')

@section('title', 'Detail Pemesanan')

@section('content')
<div class="container py-4">
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <h3 class="fw-bold text-danger mb-4">
        <i class="bi bi-receipt"></i> Detail Pemesanan Tiket
      </h3>

      <ul class="list-group mb-4">
        <li class="list-group-item">
          <strong>Nama Bus:</strong> {{ $booking->bus->nama ?? '-' }}
        </li>
        <li class="list-group-item">
          <strong>Tujuan:</strong> {{ $booking->destination->kota_asal ?? '-' }} →
          {{ $booking->destination->kota_tujuan ?? '-' }}
        </li>
        <li class="list-group-item">
          <strong>Tanggal Keberangkatan:</strong> {{ $booking->tanggal_keberangkatan }}
        </li>
        <li class="list-group-item">
          <strong>Jumlah Tiket:</strong> {{ $booking->jumlah_tiket }}
        </li>
        <li class="list-group-item">
          <strong>Total Harga:</strong> Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
        </li>
        <li class="list-group-item">
          <strong>Status:</strong>
          @if($booking->status === 'pending')
            <span class="badge bg-warning text-dark">Pending</span>
          @elseif($booking->status === 'confirmed')
            <span class="badge bg-success">Confirmed</span>
          @else
            <span class="badge bg-secondary">Cancelled</span>
          @endif
        </li>
      </ul>

      <a href="{{ route('bookings.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
      </a>
    </div>
  </div>
</div>
@endsection
