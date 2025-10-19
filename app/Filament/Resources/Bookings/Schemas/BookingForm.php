<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_booking')
                    ->required(),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('bus_id')
                    ->required()
                    ->numeric(),
                TextInput::make('destination_id')
                    ->required()
                    ->numeric(),
                DatePicker::make('tanggal_keberangkatan')
                    ->required(),
                TextInput::make('jumlah_tiket')
                    ->required()
                    ->numeric(),
                TextInput::make('total_harga')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'confirmed' => 'Confirmed', 'cancelled' => 'Cancelled'])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
