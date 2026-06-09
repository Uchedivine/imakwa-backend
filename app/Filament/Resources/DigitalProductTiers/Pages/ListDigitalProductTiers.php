<?php

namespace App\Filament\Resources\DigitalProductTiers\Pages;

use App\Filament\Resources\DigitalProductTiers\DigitalProductTierResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDigitalProductTiers extends ListRecords
{
    protected static string $resource = DigitalProductTierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
