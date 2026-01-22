<?php

namespace App\Filament\Resources\PitchResource\Pages;

use App\Filament\Resources\PitchResource;
use App\Models\Pitch;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ManagePitches extends ManageRecords
{
    protected static string $resource = PitchResource::class;

    protected function getHeaderActions(): array
    {
        return [
			ExportAction::make()
				->exports([
					ExcelExport::make()
						->withColumns([
							Column::make('mediaKit.story.title')
								->heading('Media Kit'),
							Column::make('mediaKit.architect.user.name')
								->heading('Architect')
								/* ->formatStateUsing(function (Pitch $record): string {
									return $record->user->name;
								}) */,
							Column::make('journalist.user.name')
								->heading('Journalist'),
							Column::make('publication.name')
								->heading('Publication'),
							Column::make('subject')
								->heading('Subject'),
							/* Column::make('message')
								->heading('Message'), */
							Column::make('created_at')
								->heading('Create Date'),
							Column::make('updated_at')
								->heading('Last Update Date'),
						])
						->askForWriterType()
				]),
            Actions\CreateAction::make()
				->label('New Pitch'),
        ];
    }
}
