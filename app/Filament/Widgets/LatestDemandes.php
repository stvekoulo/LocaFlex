<?php

namespace App\Filament\Widgets;

use App\Models\DemandeReservation;
use App\Models\DemandeService;
use Filament\Widgets\Widget;
use Illuminate\Support\Collection;

class LatestDemandes extends Widget
{
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = ['lg' => 2, 'xl' => 3];
    protected static string $view = 'filament.widgets.latest-demandes-widget';

    public function getDemandes(): Collection
    {
        $userId = auth()->id();

        $bienDemandes = DemandeReservation::where('owner_id', $userId)
            ->where('etat', 'En attente')
            ->with(['user', 'bien'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($demande) {
                return [
                    'id' => $demande->id,
                    'type' => 'bien',
                    'type_label' => 'Bien',
                    'type_color' => 'amber',
                    'created_at' => $demande->created_at->format('d/m/Y H:i'),
                    'user_name' => $demande->user->name ?? 'Utilisateur inconnu',
                    'item_title' => $demande->bien->titre ?? 'Bien non trouvé',
                    'duree' => $demande->duree,
                    'motif' => $demande->motif,
                    'url' => route('filament.loueur.resources.demande-reservations.edit', ['record' => $demande->id]),
                ];
            });

        $serviceDemandes = DemandeService::where('owner_id', $userId)
            ->where('etat', 'En attente')
            ->with(['user', 'services'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($demande) {
                return [
                    'id' => $demande->id,
                    'type' => 'service',
                    'type_label' => 'Service',
                    'type_color' => 'emerald',
                    'created_at' => $demande->created_at->format('d/m/Y H:i'),
                    'user_name' => $demande->user->name ?? 'Utilisateur inconnu',
                    'item_title' => $demande->services->titre ?? 'Service non trouvé',
                    'duree' => $demande->duree,
                    'motif' => $demande->motif,
                    'url' => route('filament.loueur.resources.demande-services.edit', ['record' => $demande->id]),
                ];
            });

        return $bienDemandes->concat($serviceDemandes)
            ->sortByDesc('created_at')
            ->take(10)
            ->values();
    }
}