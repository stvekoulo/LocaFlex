<?php

namespace App\Filament\Resources\BienResource\Pages;

use App\Filament\Resources\BienResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBien extends EditRecord
{
    protected static string $resource = BienResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\Action::make('togglePublie')
                ->label(fn (): string => $this->record->publie ? 'Dépublier' : 'Publier')
                ->icon(fn (): string => $this->record->publie ? 'heroicon-o-eye-slash' : 'heroicon-o-eye')
                ->color(fn (): string => $this->record->publie ? 'warning' : 'success')
                ->action(function (): void {
                    $this->record->update(['publie' => !$this->record->publie]);
                    $this->notify('success', $this->record->publie ? 'Bien publié avec succès' : 'Bien dépublié avec succès');
                }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
