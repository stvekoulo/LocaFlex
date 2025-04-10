<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\DemandeChart;
use App\Filament\Widgets\DemandeStateChart;
use App\Filament\Widgets\DemandeStatsOverview;
use App\Filament\Widgets\LatestDemandes;
use App\Filament\Widgets\RevenueChart;
use App\Filament\Widgets\RevenuePieChart;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('loueur')
            ->path('loueur')
            ->login()
            ->brandName('Collab')
            ->brandLogo(asset('Template/assets/images/logo/site_logo.svg'))
            ->brandLogoHeight(60)
            ->colors([
                'primary' => Color::Blue,
                'danger' => Color::Red,
                'gray' => Color::Zinc,
                'info' => Color::Cyan,
                'success' => Color::Green,
                'warning' => Color::Orange,
            ])
            ->favicon(asset('favicon.png'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                DemandeStatsOverview::class,
                RevenueChart::class,
                DemandeStateChart::class,
                RevenuePieChart::class,
                LatestDemandes::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->authGuard('web')
            ->navigationGroups([
                'Tableau de bord',
                'Demandes',
                'Gestion',
                'Finance',
                'Paramètres',
            ])
            ->sidebarCollapsibleOnDesktop()
            ->maxContentWidth('full');
    }
}
