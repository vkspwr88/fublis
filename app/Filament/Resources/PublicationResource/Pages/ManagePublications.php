<?php

namespace App\Filament\Resources\PublicationResource\Pages;

use App\Filament\Resources\PublicationResource;
use App\Http\Controllers\Admin\PublicationController;
use App\Models\Publication;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ManagePublications extends ManageRecords
{
    protected static string $resource = PublicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
				->label('New Publication')
				->using(function (array $data, string $model): Model {
					return PublicationController::create($data, $model);
				})
				->successNotification(
					Notification::make()
						->success()
						->title('Publication Added')
						->body('New publication has been created successfully.'),
				),
        ];
    }

	public function getTabs(): array
	{
		return [
			'all' => Tab::make('All')
				->badge(Publication::query()->count()),
			/* 'display_first' => Tab::make('Display First')
				->badge(Publication::query()->where('display_first', '>', 0)->count())
				->modifyQueryUsing(fn (Builder $query) => $query->where('display_first', '>', 0)), */
			'is_premium' => Tab::make('Premium')
				->badge(Publication::query()->where('is_premium', true)->count())
				->modifyQueryUsing(fn (Builder $query) => $query->where('is_premium', true)),
		];
	}
}
