<?php
namespace App\Filament\Resources\DigitalProducts;

use App\Filament\Resources\DigitalProducts\Pages;
use App\Models\DigitalProduct;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\TernaryFilter;

class DigitalProductResource extends Resource
{
    protected static ?string $model = DigitalProduct::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?string $navigationLabel = 'WC Products';

    public static function form(Schema $form): Schema
    {
        return $form->components([
            TextInput::make('name')->required(),
            TextInput::make('country')->required(),
            TextInput::make('flag_emoji'),
            Textarea::make('description'),
            TextInput::make('cover_image'),
            DateTimePicker::make('closes_at')->label('Store Closes At'),
            Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('flag_emoji')->label(''),
            TextColumn::make('name')->searchable(),
            TextColumn::make('country')->sortable(),
            TextColumn::make('closes_at')->dateTime()->sortable()->label('Closes'),
            IconColumn::make('is_active')->boolean(),
            TextColumn::make('created_at')->dateTime()->sortable(),
        ])
        ->filters([TernaryFilter::make('is_active')]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListDigitalProducts::route('/'),
            'create' => Pages\CreateDigitalProduct::route('/create'),
            'edit'   => Pages\EditDigitalProduct::route('/{record}/edit'),
            'view'   => Pages\ViewDigitalProduct::route('/{record}'),
        ];
    }
}