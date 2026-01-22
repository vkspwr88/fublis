<?php

namespace App\Livewire\Affiliates\Visits;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\AffVisit;
use App\Services\AffVisitService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class Table extends DataTableComponent
{
    protected $model = AffVisit::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
		$this->setAdditionalSelects(['aff_visits.id', 'aff_visits.campaign']);
		$this->setEmptyMessage('No record');
		$this->setDefaultSort('aff_visits.created_at', 'desc');
		$this->setSearchStatus(false);
		// $this->setHideReorderColumnUnlessReorderingEnabled();
		// $this->setReorderStatus(false);
		$this->setSortingStatus(false);
		$this->setColumnSelectStatus(false);
		// $this->setPaginationStatus(false);
		$this->setPerPageVisibilityStatus(false);

    }

	public function builder(): Builder
    {
        // dd(AffVisit::with('affList')->get());
        return AffVisitService::getQueryBuilder();
    }


    public function columns(): array
    {
        return [
            Column::make("URL", "affList.username")
				->format(
					function($username, $row, Column $column)
					{
						$url = config('app.url') . '?ref=' . $username;
						if($row->campaign){
							$url .= '&campaign=' . $row->campaign;
						}
						return $url;
					}
				),
			BooleanColumn::make("Converted", "is_converted"),
            Column::make("Date", "created_at"),
        ];
    }
}
