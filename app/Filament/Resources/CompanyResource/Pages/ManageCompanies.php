<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use App\Http\Controllers\Admin\CompanyController;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;

class ManageCompanies extends ManageRecords
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
				->label('New Studio')
				->using(function (array $data, string $model): Model {
					return CompanyController::create($data, $model);
				})
				->successNotification(
					Notification::make()
						->success()
						->title('Studio Added')
						->body('New studio has been created successfully.'),
				),
        ];
    }
}
