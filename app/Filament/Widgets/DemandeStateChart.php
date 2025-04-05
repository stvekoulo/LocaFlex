<?php

namespace App\Filament\Widgets;

use App\Models\DemandeReservation;
use App\Models\DemandeService;
use Filament\Widgets\ChartWidget;

class DemandeStateChart extends ChartWidget
{
    protected static ?string $heading = 'État des demandes';
    protected static ?string $subheading = 'Répartition des demandes de biens et services par état';
    protected static ?int $sort = 3;
    protected static ?string $maxHeight = '300px';
    protected int | string | array $columnSpan = 'full';

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
                    'backgroundColor' => ['#F59E0B', '#10B981', '#EF4444', '#3B82F6', '#06B6D4', '#F43F5E'],
                    'borderColor' => '#ffffff',
                    'borderWidth' => 2,
                    'hoverOffset' => 10,
                ],
            ],
            'labels' => ['Biens en attente', 'Biens acceptés', 'Biens refusés', 'Services en attente', 'Services acceptés', 'Services refusés'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                    'labels' => [
                        'padding' => 20,
                        'font' => [
                            'size' => 12,
                        ],
                    ],
                ],
                'tooltip' => [
                    'enabled' => true,
                ],
            ],
            'cutout' => '60%',
            'elements' => [
                'arc' => [
                    'borderWidth' => 1,
                ],
            ],
            'animation' => [
                'animateScale' => true,
                'animateRotate' => true,
            ],
            'maintainAspectRatio' => false,
        ];
    }
}