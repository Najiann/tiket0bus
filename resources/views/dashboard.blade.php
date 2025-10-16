<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard Pemesanan Kamu') }}
    </h2>
  </x-slot>

  <div class="py-8">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-bold mb-4 text-gray-700">Riwayat Pemesanan Tiket 🚌</h3>

        @if($bookings->isEmpty())
          <p class="text-gray-500">Belum ada tiket yang kamu pesan.</p>
        @else
          <table class="table-auto w-full border-collapse">
            <thead>
              <tr class="bg-gray-100 text-gray-700">
                <th class="border px-3 py-2">Bus</th>
                <th class="border px-3 py-2">Tujuan</th>
                <th class="border px-3 py-2">Tanggal</th>
                <th class="border px-3 py-2">Jumlah</th>
                <th class="border px-3 py-2">Total Harga</th>
                <th class="border px-3 py-2">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($bookings as $booking)
                <tr>
                  <td class="border px-3 py-2">{{ $booking->bus->nama }}</td>
                  <td class="border px-3 py-2">
                    {{ $booking->destination->kota_asal }} → {{ $booking->destination->kota_tujuan }}
                  </td>
                  <td class="border px-3 py-2">{{ $booking->tanggal_keberangkatan }}</td>
                  <td class="border px-3 py-2">{{ $booking->jumlah_tiket }}</td>
                  <td class="border px-3 py-2 text-red-600 font-bold">
                    Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                  </td>
                  <td class="border px-3 py-2">
                    <span class="px-2 py-1 rounded 
                      {{ $booking->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 
                         ($booking->status == 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                      {{ ucfirst($booking->status) }}
                    </span>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @endif
      </div>
    </div>
  </div>
</x-app-layout>
