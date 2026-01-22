<?php

namespace App\Filament\Pages;

use Awcodes\Curator\CuratorPlugin;
use Awcodes\Curator\Resources\MediaResource;
use Filament\Pages\Page;

class Medias extends Page
{
	protected static string $resource = MediaResource::class;

    // protected static ?string $navigationIcon = 'heroicon-o-document-text';

	public static function getNavigationIcon(): string
    {
        return CuratorPlugin::get()->getNavigationIcon();
    }

    // protected static string $view = 'filament.pages.medias';
}
