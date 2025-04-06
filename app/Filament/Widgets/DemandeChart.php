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
    protected static ?string $subheading = 'Évolution des demandes de biens et services pour l\'année en cours';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    protected static ?string $maxHeight = '300px';
    protected static ?string $pollingInterval = '300s';

    protected function getData(): array
    {
        $userId = auth()->id();
        $year = Carbon::now()->year;

        $databaseType = $this->getDatabaseType();

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

        $months = range(1, 12);
        $demandesBienCounts = array_map(function ($month) use ($demandesBienData) {
            return $demandesBienData[$month] ?? 0;
        }, $months);

        $demandesServiceCounts = array_map(function ($month) use ($demandesServiceData) {
            return $demandesServiceData[$month] ?? 0;
        }, $months);

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
                    'borderWidth' => 2,
                    'tension' => 0.3,
                ],
                [
                    'label' => 'Demandes de services',
                    'data' => $demandesServiceCounts,
                    'backgroundColor' => '#10B981',
                    'borderColor' => '#059669',
                    'borderWidth' => 2,
                    'tension' => 0.3,
                ],
            ],
            'labels' => $monthNames,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
                'tooltip' => [
                    'mode' => 'index',
                    'intersect' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ],
            'elements' => [
                'line' => [
                    'fill' => 'start',
                ],
                'point' => [
                    'radius' => 4,
                    'hitRadius' => 10,
                    'hoverRadius' => 6,
                ],
            ],
        ];
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