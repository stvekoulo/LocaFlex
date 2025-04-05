<?php

namespace App\Filament\Widgets;

use App\Models\DemandeReservation;
use App\Models\DemandeService;
use Filament\Widgets\ChartWidget;

class DemandeStateChart extends ChartWidget
{
    protected static ?string $heading = 'État des demandes';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $userId = auth()->id();

        // Comptage des demandes de biens par état
        $bienEnAttente = DemandeReservation::where('owner_id', $userId)->where('etat', 'En attente')->count();
        $bienAccepte = DemandeReservation::where('owner_id', $userId)->where('etat', 'Validé')->count();
        $bienRefuse = DemandeReservation::where('owner_id', $userId)->where('etat', 'Refusé')->count();

        // Comptage des demandes de services par état
        $serviceEnAttente = DemandeService::where('owner_id', $userId)->where('etat', 'En attente')->count();
        $serviceAccepte = DemandeService::where('owner_id', $userId)->where('etat', 'Validé')->count();
        $serviceRefuse = DemandeService::where('owner_id', $userId)->where('etat', 'Refusé')->count();

        return [
            'datasets' => [
                [
                    'label' => 'État des demandes',
                    'data' => [$bienEnAttente, $bienAccepte, $bienRefuse, $serviceEnAttente, $serviceAccepte, $serviceRefuse],
                    'backgroundColor' => ['#F59E0B', '#10B981', '#EF4444', '#F59E0B', '#10B981', '#EF4444'],
                ],
            ],
            'labels' => ['Biens en attente', 'Biens acceptés', 'Biens refusés', 'Services en attente', 'Services acceptés', 'Services refusés'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}