<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BookingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kode_booking'),
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('bus_id')
                    ->numeric(),
                TextEntry::make('destination_id')
                    ->numeric(),
                TextEntry::make('tanggal_keberangkatan')
                    ->date(),
                TextEntry::make('jumlah_tiket')
                    ->numeric(),
                TextEntry::make('total_harga')
                    ->numeric(),
                TextEntry::make('status'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
