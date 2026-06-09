<?php
namespace App\Filament\Resources\Newsletter;

use App\Filament\Resources\Newsletter\Pages;
use App\Models\Newsletter;
use App\Models\NewsletterSubscriber;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\Action;

class NewsletterResource extends Resource
{
    protected static ?string $model = Newsletter::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-paper-airplane';
    protected static ?string $navigationLabel = 'Newsletters';

    public static function form(Schema $form): Schema
    {
        return $form->components([
            TextInput::make('subject')->required(),
            Select::make('list')->options([
                'all'          => 'All Subscribers',
                'general'      => 'General',
                'inner_circle' => 'Inner Circle',
            ])->default('all')->required(),
            Textarea::make('body')->required()->rows(10),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('subject')->searchable(),
            TextColumn::make('list')->badge(),
            TextColumn::make('status')->badge()->color(fn($state) => match($state) {
                'sent'  => 'success',
                default => 'gray',
            }),
            TextColumn::make('recipient_count')->label('Recipients'),
            TextColumn::make('sent_at')->dateTime()->sortable(),
            TextColumn::make('created_at')->dateTime()->sortable(),
        ])
        ->filters([
            SelectFilter::make('status')->options([
                'draft' => 'Draft',
                'sent'  => 'Sent',
            ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListNewsletters::route('/'),
            'create' => Pages\CreateNewsletter::route('/create'),
            'edit'   => Pages\EditNewsletter::route('/{record}/edit'),
            'view'   => Pages\ViewNewsletter::route('/{record}'),
        ];
    }
}