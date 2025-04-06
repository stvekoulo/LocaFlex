<?php

namespace App\Filament\Widgets;

use App\Models\Paiement;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class RevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Évolution des revenus';
    protected static ?string $subheading = 'Revenus mensuels pour l\'année en cours';
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $userId = auth()->id();
        $year = Carbon::now()->year;

        $databaseType = config('database.default') === 'pgsql' ? 'pgsql' : 'mysql';

        if ($databaseType === 'pgsql') {
            // PostgreSQL
            $revenueData = DB::table('paiements')
                ->select(DB::raw('EXTRACT(MONTH FROM created_at) as month'), DB::raw('SUM(montant) as total'))
                ->where('owner_id', $userId)
                ->where('etat', 'Payé')
                ->where(DB::raw('EXTRACT(YEAR FROM created_at)'), $year)
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->keyBy('month')
                ->map(function ($item) {
                    return $item->total;
                })
                ->toArray();

            $pendingData = DB::table('paiements')
                ->select(DB::raw('EXTRACT(MONTH FROM created_at) as month'), DB::raw('SUM(montant) as total'))
                ->where('owner_id', $userId)
                ->where('etat', 'En attente de paiement')
                ->where(DB::raw('EXTRACT(YEAR FROM created_at)'), $year)
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->keyBy('month')
                ->map(function ($item) {
                    return $item->total;
                })
                ->toArray();
        } else {
            // MySQL
            $revenueData = DB::table('paiements')
                ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(montant) as total'))
                ->where('owner_id', $userId)
                ->where('etat', 'Payé')
                ->whereYear('created_at', $year)
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->keyBy('month')
                ->map(function ($item) {
                    return $item->total;
                })
                ->toArray();

            $pendingData = DB::table('paiements')
                ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(montant) as total'))
                ->where('owner_id', $userId)
                ->where('etat', 'En attente de paiement')
                ->whereYear('created_at', $year)
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->keyBy('month')
                ->map(function ($item) {
                    return $item->total;
                })
                ->toArray();
        }

        $months = range(1, 12);
        $revenueValues = array_map(function ($month) use ($revenueData) {
            return $revenueData[$month] ?? 0;
        }, $months);

        $pendingValues = array_map(function ($month) use ($pendingData) {
            return $pendingData[$month] ?? 0;
        }, $months);

        $monthNames = [
            'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
            'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Revenus encaissés',
                    'data' => $revenueValues,
                    'backgroundColor' => 'rgba(34, 197, 94, 0.5)',
                    'borderColor' => '#16a34a',
                    'borderWidth' => 2,
                    'fill' => true,
                ],
                [
                    'label' => 'Revenus en attente',
                    'data' => $pendingValues,
                    'backgroundColor' => 'rgba(245, 158, 11, 0.5)',
                    'borderColor' => '#d97706',
                    'borderWidth' => 2,
                    'fill' => true,
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
                    'position' => 'top',
                ],
                'tooltip' => [
                    'mode' => 'index',
                    'intersect' => false,
                    'callbacks' => [
                        'label' => '
                            function(context) {
                                let label = context.dataset.label || "";
                                let value = context.parsed.y;
                                return label + ": " + new Intl.NumberFormat("fr-FR").format(value) + " XOF";
                            }
                        ',
                    ],
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'callback' => '
                            function(value) {
                                return new Intl.NumberFormat("fr-FR", {
                                    notation: "compact",
                                    compactDisplay: "short"
                                }).format(value) + " XOF";
                            }
                        ',
                    ],
                ],
            ],
            'elements' => [
                'line' => [
                    'tension' => 0.3,
                ],
                'point' => [
                    'radius' => 4,
                    'hitRadius' => 10,
                    'hoverRadius' => 6,
                ],
            ],
        ];
    }
}