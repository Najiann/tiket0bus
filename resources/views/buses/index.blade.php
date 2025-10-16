@extends('layouts.app')

@section('title', 'Daftar Bus & Tujuan')

@section('content')
<div class="container py-5">
  <h2 class="text-center mb-4 text-danger fw-bold">Pilih Bus & Tujuan Perjalanan Kamu 🚍</h2>

  <div class="row g-4">
    @foreach($buses as $bus)
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title fw-bold">
              {{ $bus->destination->kota_asal ?? 'Asal tidak diketahui' }} → 
              {{ $bus->destination->kota_tujuan ?? 'Tujuan tidak diketahui' }}
            </h5>
            <p class="text-muted mb-1">Bus: {{ $bus->nama }}</p>
            <p class="text-muted mb-1">Tipe: {{ $bus->tipe }}</p>
            <p class="text-muted mb-1">Kapasitas: {{ $bus->kapasitas }} orang</p>
            <h6 class="fw-bold text-danger mt-3">
              Rp {{ number_format($bus->harga, 0, ',', '.') }}
            </h6>

            @auth
              <a href="{{ route('bookings.create', ['bus_id' => $bus->id]) }}" 
                 class="btn btn-danger w-100 mt-3">
                <i class="bi bi-ticket-perforated"></i> Pesan Sekarang
              </a>
            @else
              <div class="alert alert-secondary mt-3 text-center py-2">
                <small>Login untuk memesan tiket</small>
              </div>
            @endauth
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
