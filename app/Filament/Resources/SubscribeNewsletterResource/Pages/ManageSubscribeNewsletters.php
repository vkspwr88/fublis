<?php

namespace App\Filament\Resources\SubscribeNewsletterResource\Pages;

use App\Filament\Resources\SubscribeNewsletterResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSubscribeNewsletters extends ManageRecords
{
    protected static string $resource = SubscribeNewsletterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
