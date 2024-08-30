<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use FilipFonal\FilamentLogManager\Pages\Logs as PagesLogs;

class Logs extends PagesLogs
{
	public static function canAccess(): bool
	{
		return auth()->user()->hasRole('Super Admin');
	}
    // protected static ?string $navigationIcon = 'heroicon-o-document-text';

    // protected static string $view = 'filament.pages.logs';

	/* protected function getHeaderWidgets(): array
	{
		return [
			// StatsOverviewWidget::class
		];
	} */
}
