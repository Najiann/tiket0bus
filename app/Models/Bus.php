<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\ErrorHandler\Debug;

class Bus extends Model
{
    //
    use hasFactory;
    protected $fillable = [
        'nama', 
        'tipe', 
        'kapasitas', 
        'gambar', 
        'fasilitas',
        'harga',
        'destination_id'
    ];

    //relasi ke booking

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id'); 
    }

}
