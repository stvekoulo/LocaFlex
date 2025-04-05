<?php

namespace App\Filament\Resources\DemandeServiceResource\Pages;

use App\Filament\Resources\DemandeServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDemandeService extends EditRecord
{
    protected static string $resource = DemandeServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
