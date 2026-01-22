<?php

namespace App\Filament\Resources\JournalistResource\Pages;

use App\Filament\Resources\JournalistResource;
use App\Models\Journalist;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListJournalists extends ListRecords
{
    protected static string $resource = JournalistResource::class;

    protected function getHeaderActions(): array
    {
        return [
			ExportAction::make()
				->exports([
					ExcelExport::make()
						->withColumns([
							Column::make('slug'),
							Column::make('user.name')
								->heading('Name'),
							Column::make('user.email')
								->heading('Email'),
							Column::make('publications')
								->heading('Publication')
								->formatStateUsing(function (Journalist $record): string {
									return $record->publications->implode('name', ', ');
								}),
							Column::make('associatedPublications')
								->heading('Associated Publications')
								->formatStateUsing(function (Journalist $record): string {
									return $record->associatedPublications->implode('name', ', ');
									// return $record->associatedPublications->implode(function ($publication) {
									// 	return $publication->name . ' - ' . $publication->position->name;
									// }, '\n');
								}),
							/* Column::make('user_role')
								->formatStateUsing(function (Journalist $record): string {
									return $record->user_role->label();
								}), */
							Column::make('position.name')
								->heading('Position'),
							Column::make('location.name')
								->heading('Location'),
							Column::make('about_me'),
							Column::make('created_at')
								->heading('Create Date'),
							Column::make('updated_at')
								->heading('Last Update Date'),
						])
						// ->askForFilename()
        				->askForWriterType()
				]),
            Actions\CreateAction::make()
				->label('New Journalist'),
        ];
    }
}
