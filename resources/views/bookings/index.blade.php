@extends('layouts.app')

@section('title', 'Pesan Tiket Bus')

@section('content')
  <h1 class="text-center fw-bold text-danger mb-5">Pilih Tiket Bus Kamu Di Tripz🚍</h1>

  <div class="row g-4">
    @foreach($buses as $bus)
      <div class="col-md-4">
        <div class="card shadow-sm h-100 border-0">
          <div class="card-body">
            {{-- Judul: Rute Perjalanan --}}
            <h5 class="card-title fw-bold">
              {{ $bus->destination->kota_asal }} → {{ $bus->destination->kota_tujuan }}
            </h5>

            {{-- Info Bus --}}
            <p class="text-muted mb-1">Bus: {{ $bus->nama }} ({{ $bus->tipe }})</p>
            <p class="text-muted mb-1">Kapasitas: {{ $bus->kapasitas }} orang</p>

            {{-- Info Rute --}}
            <p class="text-muted mb-1">Durasi: {{ $bus->destination->durasi }} jam</p>
            <p class="text-muted mb-1">Jarak: {{ $bus->destination->jarak }}</p>

             {{-- Harga --}}
            <h6 class="fw-bold text-danger mt-3">
              Rp {{ number_format($bus->harga, 0, ',', '.') }}
            </h6>

            {{-- Tombol --}}
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
@endsection
