<?php

namespace App\Filament\Widgets;

use App\Models\Bien;
use App\Models\Service;
use App\Models\DemandeReservation;
use App\Models\DemandeService;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DemandeStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $userId = auth()->id();

        $totalBiens = Bien::where('user_id', $userId)->count();
        $biensPublies = Bien::where('user_id', $userId)->where('publie', true)->count();

        $totalServices = Service::where('user_id', $userId)->count();
        $servicesPublies = Service::where('user_id', $userId)->where('publie', true)->count();

        $totalDemandesBiens = DemandeReservation::where('owner_id', $userId)->count();
        $demandesBiensEnAttente = DemandeReservation::where('owner_id', $userId)->where('etat', 'En attente')->count();

        $totalDemandesServices = DemandeService::where('owner_id', $userId)->count();
        $demandesServicesEnAttente = DemandeService::where('owner_id', $userId)->where('etat', 'En attente')->count();

        return [
            Stat::make('Biens', $totalBiens)
                ->description($biensPublies . ' biens publiés')
                ->descriptionIcon('heroicon-m-home')
                ->color('primary'),

            Stat::make('Services', $totalServices)
                ->description($servicesPublies . ' services publiés')
                ->descriptionIcon('heroicon-m-wrench')
                ->color('success'),

            Stat::make('Demandes de biens', $totalDemandesBiens)
                ->description($demandesBiensEnAttente . ' en attente')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color($demandesBiensEnAttente > 0 ? 'warning' : 'primary'),

            Stat::make('Demandes de services', $totalDemandesServices)
                ->description($demandesServicesEnAttente . ' en attente')
                ->descriptionIcon('heroicon-m-clipboard-document-check')
                ->color($demandesServicesEnAttente > 0 ? 'warning' : 'success'),
        ];
    }
}