<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'kode_booking',
        'user_id',
        'bus_id',
        'destination_id',
        'tanggal_keberangkatan',
        'jumlah_tiket',
        'total_harga',
        'status'
    ];

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi ke bus
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    // relasi ke destination
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
