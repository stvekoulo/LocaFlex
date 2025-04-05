<?php

namespace App\Filament\Resources\RevenueResource\Widgets;

use App\Models\Paiement;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class RevenueOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $userId = auth()->id();

        $totalRevenue = Paiement::where('owner_id', $userId)
            ->where('etat', 'Payé')
            ->sum('montant');

        $pendingRevenue = Paiement::where('owner_id', $userId)
            ->where('etat', 'En attente de paiement')
            ->sum('montant');

        $revenueByBien = Paiement::where('owner_id', $userId)
            ->where('etat', 'Payé')
            ->whereNotNull('bien_id')
            ->sum('montant');

        $revenueByService = Paiement::where('owner_id', $userId)
            ->where('etat', 'Payé')
            ->whereNotNull('service_id')
            ->sum('montant');

        return [
            Stat::make('Revenus totaux', number_format($totalRevenue) . ' XOF')
                ->description('Tous les paiements reçus')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Revenus en attente', number_format($pendingRevenue) . ' XOF')
                ->description('Paiements non encore effectués')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Revenus des biens', number_format($revenueByBien) . ' XOF')
                ->description(round($totalRevenue > 0 ? ($revenueByBien / $totalRevenue) * 100 : 0) . '% du total')
                ->descriptionIcon('heroicon-m-home')
                ->color('primary'),

            Stat::make('Revenus des services', number_format($revenueByService) . ' XOF')
                ->description(round($totalRevenue > 0 ? ($revenueByService / $totalRevenue) * 100 : 0) . '% du total')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('info'),
        ];
    }
}