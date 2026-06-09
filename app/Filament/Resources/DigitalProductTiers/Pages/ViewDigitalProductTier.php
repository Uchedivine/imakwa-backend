<?php

namespace App\Filament\Resources\DigitalProductTiers\Pages;

use App\Filament\Resources\DigitalProductTiers\DigitalProductTierResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDigitalProductTier extends ViewRecord
{
    protected static string $resource = DigitalProductTierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
