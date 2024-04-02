<?php

namespace App\Providers\Filament;

use App\Filament\Resources;
use Filament\Navigation;
use Awcodes\Curator\Resources\MediaResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('backend')
            ->path('backend')
            ->login()
            ->colors([
                'primary' => '#6941C6'/* Color::Amber */,
            ])
			->viteTheme('resources/css/filament/backend/theme.css')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
			->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
			->plugins([
				\Awcodes\Curator\CuratorPlugin::make()
					->label('Media')
					->pluralLabel('Media')
					->navigationIcon('heroicon-o-photo')
					->navigationGroup('Content')
					->navigationSort(3)
					->navigationCountBadge()
					->resource(MediaResource::class),
			])
			->navigation(function (Navigation\NavigationBuilder $builder): Navigation\NavigationBuilder {
				return $builder->items([
					Navigation\NavigationItem::make('Dashboard')
						->icon('heroicon-o-home')
						->isActiveWhen(fn (): bool => request()->routeIs('filament.admin.pages.dashboard'))
						->url(fn (): string => Pages\Dashboard::getUrl()),

					...Resources\UserResource::getNavigationItems(),
					...MediaResource::getNavigationItems(),
					...Resources\ImageLogResource::getNavigationItems(),
				])->groups([
					Navigation\NavigationGroup::make('Architects')
					->items([
						...Resources\ArchitectResource::getNavigationItems(),
						...Resources\ArchitectPositionResource::getNavigationItems(),
					])
					->icon('heroicon-o-rectangle-stack'),

					Navigation\NavigationGroup::make('Studios')
					->items([
						...Resources\CompanyResource::getNavigationItems(),
						...Resources\TeamSizeResource::getNavigationItems(),
					])
					->icon('heroicon-o-rectangle-stack'),

					Navigation\NavigationGroup::make('Journalists')
					->items([
						...Resources\JournalistResource::getNavigationItems(),
						...Resources\JournalistPositionResource::getNavigationItems(),
					])
					->icon('heroicon-o-rectangle-stack'),

					Navigation\NavigationGroup::make('Publications')
					->items([
						...Resources\PublicationResource::getNavigationItems(),
						...Resources\PublicationTypeResource::getNavigationItems(),
					])
					->icon('heroicon-o-rectangle-stack'),

					Navigation\NavigationGroup::make('Top Journalists')
					->items([
						...Resources\TopJournalistResource::getNavigationItems(),
						...Resources\TopJournalistListResource::getNavigationItems(),
					])
					->icon('heroicon-o-rectangle-stack'),

					Navigation\NavigationGroup::make('Top Publications')
					->items([
						...Resources\TopPublicationResource::getNavigationItems(),
						...Resources\TopPublicationListResource::getNavigationItems(),
					])
					->icon('heroicon-o-rectangle-stack'),

					Navigation\NavigationGroup::make('Media Kits')
					->items([
						...Resources\ArticleResource::getNavigationItems(),
						...Resources\PressReleaseResource::getNavigationItems(),
						...Resources\ProjectResource::getNavigationItems(),
					])
					->icon('heroicon-o-rectangle-stack'),

					Navigation\NavigationGroup::make('Calls')
					->items([
						...Resources\CallResource::getNavigationItems(),
					])
					->icon('heroicon-o-rectangle-stack'),

					Navigation\NavigationGroup::make('Pitches')
					->items([
						...Resources\PitchResource::getNavigationItems(),
					])
					->icon('heroicon-o-rectangle-stack'),

					Navigation\NavigationGroup::make('Location')
					->items([
						...Resources\CountryResource::getNavigationItems(),
						...Resources\StateResource::getNavigationItems(),
						...Resources\CityResource::getNavigationItems(),
					])
					->icon('heroicon-o-rectangle-stack'),

					Navigation\NavigationGroup::make('Stripe')
					->items([
						...Resources\SubscriptionPlanResource::getNavigationItems(),
						...Resources\SubscriptionPriceResource::getNavigationItems(),
					])
					->icon('heroicon-o-rectangle-stack'),

					Navigation\NavigationGroup::make('Settings')
					->items([
						...Resources\AreaResource::getNavigationItems(),
						...Resources\BuildingTypologyResource::getNavigationItems(),
						...Resources\BuildingUseResource::getNavigationItems(),
						...Resources\CategoryResource::getNavigationItems(),
						...Resources\FaqResource::getNavigationItems(),
						...Resources\LanguageResource::getNavigationItems(),
						...Resources\PublishFromResource::getNavigationItems(),
						...Resources\ProjectStatusResource::getNavigationItems(),
						...Resources\SettingResource::getNavigationItems(),
						...Resources\SocialMediaResource::getNavigationItems(),
					])
					->icon('heroicon-o-rectangle-stack'),
				]);
			})
			->sidebarFullyCollapsibleOnDesktop();
    }
}
