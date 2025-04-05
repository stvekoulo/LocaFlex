<?php

namespace App\Filament\Resources\BienResource\Pages;

use App\Filament\Resources\BienResource;
use App\Models\Photo;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateBien extends CreateRecord
{
    protected static string $resource = BienResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        // On retire les photos du tableau de données pour ne pas les sauvegarder dans le modèle Bien
        $photos = $data['photos'] ?? [];
        unset($data['photos']);

        // Création du bien
        $bien = static::getModel()::create($data);

        // Sauvegarde des photos
        foreach ($photos as $photo) {
            Photo::create([
                'chemin_fichier' => $photo,
                'description' => 'Photo du bien',
                'bien_id' => $bien->id,
            ]);
        }

        return $bien;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
