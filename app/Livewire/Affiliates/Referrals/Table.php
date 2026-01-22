<?php

namespace App\Livewire\Affiliates\Referrals;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\AffReferral;
use App\Services\AffReferralService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Table extends DataTableComponent
{
    protected $model = AffReferral::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
		$this->setAdditionalSelects(['aff_referrals.id', 'aff_referrals.earned_currency']);
		$this->setEmptyMessage('No record');
		$this->setDefaultSort('aff_referrals.created_at', 'desc');
		$this->setSearchStatus(false);
		$this->setSortingStatus(false);
		$this->setColumnSelectStatus(false);
		$this->setPerPageVisibilityStatus(false);
    }

	public function builder(): Builder
    {
        // dd(AffVisit::with('affList')->get());
        return AffReferralService::getQueryBuilder();
    }

    public function columns(): array
    {
        return [
            Column::make("Reference", "user.name"),
            Column::make("Amount", "earned_amount")
				->label(
					fn($row, Column $column)  => displayCurrencyValue($row->earned_amount)
				),
            Column::make("Description", "description"),
            Column::make("Status", "earned_amount")
				->label(
					fn($row, Column $column)  => '<strong>' . ($row->earned_amount > 0 ? '<span class="text-green-600">PAID</span>' : '<span class="text-red-600">NOT PAID</span>') . '</strong>'
				)
				->html(),
            Column::make("Date", "created_at"),
        ];
    }
}
