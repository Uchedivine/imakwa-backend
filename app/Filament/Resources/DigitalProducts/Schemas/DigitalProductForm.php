<?php

namespace App\Filament\Resources\DigitalProducts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DigitalProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                FileUpload::make('cover_image')
                    ->image(),
                TextInput::make('country')
                    ->required(),
                TextInput::make('flag_emoji')
                    ->default(null),
                Toggle::make('is_active')
                    ->required(),
                DateTimePicker::make('closes_at'),
            ]);
    }
}
