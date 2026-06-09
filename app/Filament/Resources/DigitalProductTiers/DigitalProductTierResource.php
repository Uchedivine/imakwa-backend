<?php
namespace App\Filament\Resources\DigitalProductTiers;

use App\Filament\Resources\DigitalProductTiers\Pages;
use App\Models\DigitalProductTier;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Actions\CreateAction;

class DigitalProductTierResource extends Resource
{
    protected static ?string $model = DigitalProductTier::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationLabel = 'WC Tiers';

    public static function form(Schema $form): Schema
    {
        return $form->components([
            Select::make('digital_product_id')->relationship('product', 'name')->required()->label('Product'),
            Select::make('tier')->options([
                'I'   => 'Tier I',
                'II'  => 'Tier II',
                'III' => 'Tier III',
                'IV'  => 'Tier IV',
            ])->required(),
            TextInput::make('label')->required(),
            Textarea::make('description'),
            TextInput::make('price')->numeric()->required(),
            TextInput::make('currency')->default('USD'),
            TextInput::make('license_count')->numeric()->required()->label('Total Licenses'),
            TextInput::make('licenses_sold')->numeric()->default(0)->label('Licenses Sold'),
            TextInput::make('download_url')->label('Download URL'),
            Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('product.name')->label('Product')->sortable(),
            TextColumn::make('tier')->badge()->sortable(),
            TextColumn::make('label')->searchable(),
            TextColumn::make('price')->money('USD')->sortable(),
            TextColumn::make('license_count')->label('Total'),
            TextColumn::make('licenses_sold')->label('Sold'),
            IconColumn::make('is_active')->boolean(),
        ])
        ->filters([
            SelectFilter::make('tier')->options([
                'I' => 'Tier I', 'II' => 'Tier II', 'III' => 'Tier III', 'IV' => 'Tier IV',
            ]),
            TernaryFilter::make('is_active'),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListDigitalProductTiers::route('/'),
            'create' => Pages\CreateDigitalProductTier::route('/create'),
            'edit'   => Pages\EditDigitalProductTier::route('/{record}/edit'),
            'view'   => Pages\ViewDigitalProductTier::route('/{record}'),
        ];
    }
}