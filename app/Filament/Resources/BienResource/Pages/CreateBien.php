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
        $photos = $data['photos'] ?? [];
        unset($data['photos']);

        $bien = static::getModel()::create($data);

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
