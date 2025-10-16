@extends('layouts.app')

@section('title', 'Tiket Saya')

@section('content')
<div class="container py-4">
  <h2 class="fw-bold text-danger mb-4">
    <i class="bi bi-journal-text"></i> Tiket Saya 🎟️
  </h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if($bookings->isEmpty())
    <div class="alert alert-secondary text-center">
      Belum ada tiket yang kamu pesan.
    </div>
  @else
    <div class="table-responsive">
      <table class="table table-bordered align-middle">
        <thead class="table-danger">
          <tr class="text-center">
            <th>#</th>
            <th>Bus</th>
            <th>Tujuan</th>
            <th>Tanggal Keberangkatan</th>
            <th>Jumlah Tiket</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($bookings as $booking)
            <tr class="text-center">
              <td>{{ $loop->iteration }}</td>
              <td>{{ $booking->bus->nama ?? '-' }}</td>
              <td>
                {{ $booking->destination->kota_asal ?? '-' }} →
                {{ $booking->destination->kota_tujuan ?? '-' }}
              </td>
              <td>{{ $booking->tanggal_keberangkatan }}</td>
              <td>{{ $booking->jumlah_tiket }}</td>
              <td>Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
              <td>
                @if($booking->status === 'pending')
                  <span class="badge bg-warning text-dark">Pending</span>
                @elseif($booking->status === 'confirmed')
                  <span class="badge bg-success">Confirmed</span>
                @else
                  <span class="badge bg-secondary">Cancelled</span>
                @endif
              </td>
              <td>
                <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-sm btn-outline-danger">
                  <i class="bi bi-eye"></i> Detail
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>
@endsection
