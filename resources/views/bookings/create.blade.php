@extends('layouts.app')

@section('title', 'Pesan Tiket Bus')

@section('content')
<div class="card shadow-sm border-0">
  <div class="card-body">
    <h3 class="fw-bold text-danger mb-4">
      <i class="bi bi-ticket-perforated"></i> Form Pemesanan Tiket
    </h3>

    {{-- Pesan sukses/error --}}
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('bookings.store') }}" method="POST">
      @csrf

      <input type="hidden" name="bus_id" value="{{ request('bus_id') }}">

      <div class="mb-3">
        <label for="nama_penumpang" class="form-label">Nama Penumpang</label>
        <input type="text" class="form-control" id="nama_penumpang" name="nama_penumpang" 
               value="{{ Auth::user()->name ?? '' }}" required>
      </div>

      <div class="mb-3">
        <label for="jumlah_tiket" class="form-label">Jumlah Tiket</label>
        <input type="number" class="form-control" id="jumlah_tiket" name="jumlah_tiket" min="1" required>
      </div>

      <div class="mb-3">
        <label for="destination_id" class="form-label">Pilih Tujuan</label>
        <select name="destination_id" id="destination_id" class="form-select" required>
          <option value="">-- Pilih Tujuan --</option>
          @foreach($destinations as $destination)
            <option value="{{ $destination->id }}">
              {{ $destination->kota_asal }} → {{ $destination->kota_tujuan }} 
              ({{ \Carbon\Carbon::parse($destination->tanggal_berangkat)->format('d M Y') }})
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="tanggal_keberangkatan" class="form-label">Tanggal Keberangkatan</label>
        <input type="date" class="form-control" id="tanggal_keberangkatan" name="tanggal_keberangkatan" required>
      </div>

      <div class="mb-3">
        <label for="total_harga" class="form-label">Total Harga (otomatis)</label>
        <input type="text" class="form-control" id="total_harga" name="total_harga" readonly>
        <small class="text-muted">Harga akan dihitung berdasarkan jumlah tiket.</small>
      </div>

      <input type="hidden" name="status" value="pending">

      <button type="submit" class="btn btn-danger w-100">
        <i class="bi bi-check-circle"></i> Konfirmasi Pemesanan
      </button>

      <a href="{{ url('/') }}" class="btn btn-outline-secondary w-100 mt-3">
        <i class="bi bi-arrow-left"></i> Kembali
      </a>
    </form>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const jumlahInput = document.getElementById('jumlah_tiket');
    const totalInput = document.getElementById('total_harga');

    const buses = @json($buses ?? []);
    const selectedBusId = "{{ request('bus_id') }}";
    const selectedBus = buses.find(bus => bus.id == selectedBusId);
    const hargaBus = selectedBus ? selectedBus.harga : 0;

    jumlahInput.addEventListener('input', () => {
      const jumlah = parseInt(jumlahInput.value || 0);
      totalInput.value = hargaBus > 0 ? "Rp " + (hargaBus * jumlah).toLocaleString('id-ID') : '';
    });
  });
</script>
@endsection
