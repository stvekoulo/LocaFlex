<?php

namespace App\Filament\Widgets;

use App\Models\Paiement;
use Filament\Widgets\ChartWidget;

class RevenuePieChart extends ChartWidget
{
    protected static ?string $heading = 'Répartition des revenus';
    protected static ?string $subheading = 'Répartition des revenus par type';
    protected static ?int $sort = 3;
    protected static ?string $maxHeight = '300px';
    protected int | string | array $columnSpan = 'half';

    protected function getData(): array
    {
        $userId = auth()->id();

        // Revenus par type de bien/service
        $revenueByBien = Paiement::where('owner_id', $userId)
            ->where('etat', 'Payé')
            ->whereNotNull('bien_id')
            ->sum('montant');

        $revenueByService = Paiement::where('owner_id', $userId)
            ->where('etat', 'Payé')
            ->whereNotNull('service_id')
            ->sum('montant');

        // Revenus par état
        $revenuePaid = Paiement::where('owner_id', $userId)
            ->where('etat', 'Payé')
            ->sum('montant');

        $revenuePending = Paiement::where('owner_id', $userId)
            ->where('etat', 'En attente de paiement')
            ->sum('montant');

        return [
            'datasets' => [
                [
                    'label' => 'Répartition des revenus',
                    'data' => [$revenueByBien, $revenueByService, $revenuePending],
                    'backgroundColor' => ['#3B82F6', '#10B981', '#F59E0B'],
                    'borderColor' => '#ffffff',
                    'borderWidth' => 2,
                    'hoverOffset' => 10,
                ],
            ],
            'labels' => ['Revenus des biens', 'Revenus des services', 'En attente de paiement'],
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
                            'size' => 11,
                        ],
                    ],
                ],
                'tooltip' => [
                    'enabled' => true,
                    'callbacks' => [
                        'label' => '
                            function(context) {
                                let label = context.label || "";
                                let value = context.raw;
                                let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                let percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                return label + ": " + new Intl.NumberFormat("fr-FR").format(value) + " XOF (" + percentage + "%)";
                            }
                        ',
                    ],
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
        ];
    }
}