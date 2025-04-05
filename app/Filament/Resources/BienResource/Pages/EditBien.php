<?php

namespace App\Filament\Resources\BienResource\Pages;

use App\Filament\Resources\BienResource;
use App\Models\Photo;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditBien extends EditRecord
{
    protected static string $resource = BienResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Récupérer les chemins des photos pour les afficher dans le formulaire
        $bien = $this->record;
        $data['photos'] = $bien->photos()->pluck('chemin_fichier')->toArray();

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // On retire les photos du tableau de données
        $photos = $data['photos'] ?? [];
        unset($data['photos']);

        // Mise à jour du bien
        $record->update($data);

        // Supprimer les anciennes photos qui ne sont plus dans le tableau
        $existingPhotos = $record->photos()->pluck('chemin_fichier')->toArray();
        $photosToDelete = array_diff($existingPhotos, $photos);

        foreach ($photosToDelete as $photoPath) {
            $photo = $record->photos()->where('chemin_fichier', $photoPath)->first();
            if ($photo) {
                $photo->delete();
            }
        }

        // Ajouter les nouvelles photos
        $newPhotos = array_diff($photos, $existingPhotos);
        foreach ($newPhotos as $photoPath) {
            Photo::create([
                'chemin_fichier' => $photoPath,
                'description' => 'Photo du bien',
                'bien_id' => $record->id,
            ]);
        }

        return $record;
    }
}
