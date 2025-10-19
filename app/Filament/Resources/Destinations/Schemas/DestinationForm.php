<?php

namespace App\Filament\Resources\Destinations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DestinationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kota_asal')
                    ->required(),
                TextInput::make('kota_tujuan')
                    ->required(),
                TextInput::make('deskripsi')
                    ->required(),
                TextInput::make('jarak')
                    ->required(),
                TextInput::make('durasi')
                    ->required()
                    ->numeric(),
            ]);
    }
}
