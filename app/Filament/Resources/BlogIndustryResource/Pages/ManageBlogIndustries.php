<?php

namespace App\Filament\Resources\BlogIndustryResource\Pages;

use App\Filament\Resources\BlogIndustryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBlogIndustries extends ManageRecords
{
    protected static string $resource = BlogIndustryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
