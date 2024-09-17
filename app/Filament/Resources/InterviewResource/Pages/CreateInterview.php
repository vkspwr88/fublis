<?php

namespace App\Filament\Resources\InterviewResource\Pages;

use App\Filament\Resources\InterviewResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateInterview extends CreateRecord
{
    protected static string $resource = InterviewResource::class;

	protected function mutateFormDataBeforeCreate(array $data): array
    {
		$data['created_by'] = Auth::id();
		$data['updated_by'] = Auth::id();
		return $data;
	}
}
