<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Destination extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'kota_asal',
        'kota_tujuan',
        'deskripsi',
        'jarak',
        'durasi'
    ];

    // relasi ke booking
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function buses()
    {
        return $this->hasMany(Bus::class, 'destination_id');
    }
}
