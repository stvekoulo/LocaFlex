<?php

namespace App\Filament\Widgets;

use App\Models\Bien;
use App\Models\Service;
use App\Models\DemandeReservation;
use App\Models\DemandeService;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Support\Colors\Color;

class DemandeStatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '60s';
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $userId = auth()->id();

        $totalBiens = Bien::where('user_id', $userId)->count();
        $biensPublies = Bien::where('user_id', $userId)->where('publie', true)->count();
        $percentBiensPublies = $totalBiens > 0 ? round(($biensPublies / $totalBiens) * 100) : 0;

        $totalServices = Service::where('user_id', $userId)->count();
        $servicesPublies = Service::where('user_id', $userId)->where('publie', true)->count();
        $percentServicesPublies = $totalServices > 0 ? round(($servicesPublies / $totalServices) * 100) : 0;

        $totalDemandesBiens = DemandeReservation::where('owner_id', $userId)->count();
        $demandesBiensEnAttente = DemandeReservation::where('owner_id', $userId)->where('etat', 'En attente')->count();
        $percentDemandesBiensEnAttente = $totalDemandesBiens > 0 ? round(($demandesBiensEnAttente / $totalDemandesBiens) * 100) : 0;

        $totalDemandesServices = DemandeService::where('owner_id', $userId)->count();
        $demandesServicesEnAttente = DemandeService::where('owner_id', $userId)->where('etat', 'En attente')->count();
        $percentDemandesServicesEnAttente = $totalDemandesServices > 0 ? round(($demandesServicesEnAttente / $totalDemandesServices) * 100) : 0;

        return [
            Stat::make('Biens', $totalBiens)
                ->description($biensPublies . ' biens publiés (' . $percentBiensPublies . '%)')
                ->descriptionIcon('heroicon-m-home')
                ->color('amber')
                ->chart([7, 3, 4, 5, 6, $totalBiens])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('go-to-biens')"
                ]),

            Stat::make('Services', $totalServices)
                ->description($servicesPublies . ' services publiés (' . $percentServicesPublies . '%)')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('emerald')
                ->chart([2, 3, 4, $totalServices, 6, 7])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('go-to-services')"
                ]),

            Stat::make('Demandes de biens', $totalDemandesBiens)
                ->description($demandesBiensEnAttente . ' en attente (' . $percentDemandesBiensEnAttente . '%)')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color($demandesBiensEnAttente > 0 ? 'orange' : 'blue')
                ->chart([3, 2, $demandesBiensEnAttente, 8, 4, 9])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('go-to-demandes-bien')"
                ]),

            Stat::make('Demandes de services', $totalDemandesServices)
                ->description($demandesServicesEnAttente . ' en attente (' . $percentDemandesServicesEnAttente . '%)')
                ->descriptionIcon('heroicon-m-clipboard-document-check')
                ->color($demandesServicesEnAttente > 0 ? 'orange' : 'blue')
                ->chart([1, 6, $demandesServicesEnAttente, 2, 5, 7])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('go-to-demandes-service')"
                ]),
        ];
    }
}