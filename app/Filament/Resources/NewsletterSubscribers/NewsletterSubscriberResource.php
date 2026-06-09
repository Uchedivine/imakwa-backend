<?php
namespace App\Filament\Resources\NewsletterSubscribers;

use App\Filament\Resources\NewsletterSubscribers\Pages;
use App\Models\NewsletterSubscriber;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class NewsletterSubscriberResource extends Resource
{
    protected static ?string $model = NewsletterSubscriber::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Subscribers';

    public static function form(Schema $form): Schema
    {
        return $form->components([
            TextInput::make('email')->email()->required(),
            TextInput::make('name'),
            Select::make('list')->options([
                'general'      => 'General',
                'inner_circle' => 'Inner Circle',
            ])->default('general'),
            Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('email')->searchable(),
            TextColumn::make('name')->searchable(),
            TextColumn::make('list')->badge()->color(fn($state) => match($state) {
                'inner_circle' => 'warning',
                default        => 'gray',
            }),
            IconColumn::make('is_active')->boolean(),
            TextColumn::make('created_at')->dateTime()->sortable(),
        ])
        ->filters([
            SelectFilter::make('list')->options([
                'general'      => 'General',
                'inner_circle' => 'Inner Circle',
            ]),
            TernaryFilter::make('is_active'),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListNewsletterSubscribers::route('/'),
            'create' => Pages\CreateNewsletterSubscriber::route('/create'),
            'edit'   => Pages\EditNewsletterSubscriber::route('/{record}/edit'),
            'view'   => Pages\ViewNewsletterSubscriber::route('/{record}'),
        ];
    }
}