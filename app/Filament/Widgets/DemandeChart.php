<?php

namespace App\Filament\Widgets;

use App\Models\DemandeReservation;
use App\Models\DemandeService;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class DemandeChart extends ChartWidget
{
    protected static ?string $heading = 'Demandes par mois';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $userId = auth()->id();
        $year = Carbon::now()->year;

        // Déterminer le type de base de données
        $databaseType = $this->getDatabaseType();

        // Requêtes adaptées selon le type de base de données
        if ($databaseType === 'pgsql') {
            // PostgreSQL
            $demandesBienData = DB::table('demande_reservations')
                ->select(DB::raw('EXTRACT(MONTH FROM created_at) as month'), DB::raw('count(*) as count'))
                ->where('owner_id', $userId)
                ->where(DB::raw('EXTRACT(YEAR FROM created_at)'), $year)
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month')
                ->toArray();

            $demandesServiceData = DB::table('demande_services')
                ->select(DB::raw('EXTRACT(MONTH FROM created_at) as month'), DB::raw('count(*) as count'))
                ->where('owner_id', $userId)
                ->where(DB::raw('EXTRACT(YEAR FROM created_at)'), $year)
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month')
                ->toArray();
        } else {
            // MySQL ou autre
            $demandesBienData = DB::table('demande_reservations')
                ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
                ->where('owner_id', $userId)
                ->whereYear('created_at', $year)
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month')
                ->toArray();

            $demandesServiceData = DB::table('demande_services')
                ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
                ->where('owner_id', $userId)
                ->whereYear('created_at', $year)
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month')
                ->toArray();
        }

        // Préparation des tableaux pour le graphique
        $months = range(1, 12);
        $demandesBienCounts = array_map(function ($month) use ($demandesBienData) {
            return $demandesBienData[$month] ?? 0;
        }, $months);

        $demandesServiceCounts = array_map(function ($month) use ($demandesServiceData) {
            return $demandesServiceData[$month] ?? 0;
        }, $months);

        // Noms des mois en français
        $monthNames = [
            'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
            'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Demandes de biens',
                    'data' => $demandesBienCounts,
                    'backgroundColor' => '#F59E0B',
                    'borderColor' => '#D97706',
                ],
                [
                    'label' => 'Demandes de services',
                    'data' => $demandesServiceCounts,
                    'backgroundColor' => '#10B981',
                    'borderColor' => '#059669',
                ],
            ],
            'labels' => $monthNames,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    /**
     * Déterminer le type de base de données utilisé
     *
     * @return string
     */
    private function getDatabaseType(): string
    {
        return config('database.default') === 'pgsql' ? 'pgsql' : 'mysql';
    }
}