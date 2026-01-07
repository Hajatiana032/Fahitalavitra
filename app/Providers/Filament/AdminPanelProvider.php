<?php

namespace App\Providers\Filament;

use Filament\Enums\UserMenuPosition;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
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
            ->id('admin')
            ->path('admin')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->login()
            ->colors([
                'primary' => '#56c68a',
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->middleware([
                EncryptCookies::class,
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
            ->spa()
            ->userMenu(position: UserMenuPosition::Sidebar)
            ->brandName('Fahitalavitra')
            ->registration()
            ->passwordReset()
            ->emailVerification()
            ->profile(isSimple: false)
            ->loginRouteSlug('connexion')
            ->registrationRouteSlug('inscription')
            ->emailVerificationRouteSlug('verification')
            ->passwordResetRoutePrefix('mot-de-passe-oublié')
            ->passwordResetRequestRouteSlug('requête')
            ->emailVerificationRouteSlug('verification')
            ->authGuard('web')
            ->brandLogo(fn() => view('filament.admin.logo'))
            ->brandLogoHeight('2rem')
            ->favicon(asset('logo.svg'))
            ->font('Inter')
            ->navigationItems([
                NavigationItem::make('site')->label('Voir le site')
                    ->url('/')
                    ->icon('heroicon-o-arrow-uturn-left'),
            ]);
    }
}
