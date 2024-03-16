<?php

namespace App\Filament\Resources\SubscriptionPriceResource\Pages;

use App\Filament\Resources\SubscriptionPriceResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSubscriptionPrices extends ManageRecords
{
    protected static string $resource = SubscriptionPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
