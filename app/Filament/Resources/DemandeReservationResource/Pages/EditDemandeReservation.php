<?php

namespace App\Filament\Resources\DemandeReservationResource\Pages;

use App\Filament\Resources\DemandeReservationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDemandeReservation extends EditRecord
{
    protected static string $resource = DemandeReservationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
