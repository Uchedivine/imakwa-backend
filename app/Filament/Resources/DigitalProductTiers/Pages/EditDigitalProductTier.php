<?php

namespace App\Filament\Resources\DigitalProductTiers\Pages;

use App\Filament\Resources\DigitalProductTiers\DigitalProductTierResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditDigitalProductTier extends EditRecord
{
    protected static string $resource = DigitalProductTierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
