<?php

namespace App\Filament\Resources\ArchitectResource\Pages;

use App\Filament\Exports\ArchitectExporter;
use App\Filament\Resources\ArchitectResource;
use App\Models\Architect;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ListArchitects extends ListRecords
{
    protected static string $resource = ArchitectResource::class;

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
							Column::make('company.name')
								->heading('Studio'),
							Column::make('user_role')
								->formatStateUsing(function (Architect $record): string {
									return $record->user_role->label();
								}),
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
						->askForWriterType()
				]),
			/* Actions\ExportAction::make()
				->exporter(ArchitectExporter::class), */
            Actions\CreateAction::make()
				->label('New Architect'),
        ];
    }
}
