@extends('layouts.app')

@section('title', 'Daftar Tujuan')

@section('content')
<div class="container py-5">
  <h2 class="text-center mb-4 text-danger fw-bold">Daftar Tujuan Perjalanan 🌍</h2>

  <div class="row g-4">
    @forelse ($destinations as $destination)
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title fw-bold">{{ $destination->nama }}</h5>
            <p class="text-muted mb-2">{{ $destination->deskripsi }}</p>
            <p class="fw-bold text-danger">Rp {{ number_format($destination->harga, 0, ',', '.') }}</p>

            <a href="{{ route('bookings.create', ['destination_id' => $destination->id]) }}" 
               class="btn btn-danger w-100 mt-2">
              <i class="bi bi-geo-alt-fill"></i> Pilih Tujuan Ini
            </a>
          </div>
        </div>
      </div>
    @empty
      <p class="text-center text-muted">Belum ada destinasi tersedia.</p>
    @endforelse
  </div>
</div>
@endsection
