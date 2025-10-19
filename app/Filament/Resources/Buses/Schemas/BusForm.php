<?php

namespace App\Filament\Resources\Buses\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BusForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                TextInput::make('tipe')
                    ->required(),
                TextInput::make('gambar')
                    ->required(),
                TextInput::make('fasilitas')
                    ->required(),
                TextInput::make('kapasitas')
                    ->required()
                    ->numeric(),
                TextInput::make('harga')
                    ->required()
                    ->numeric(),
                TextInput::make('destination_id')
                    ->numeric(),
            ]);
    }
}
