<?php

namespace App\Livewire\Architects\Account;

use App\Http\Controllers\Users\CompanyController;
use Livewire\Component;
use Livewire\WithPagination;

class Studio extends Component
{
	use WithPagination;

    public function render()
    {
		$brand = CompanyController::getArchitectCompany(auth()->id());
		$brand = CompanyController::loadModel($brand);
        return view('livewire.architects.account.studio', [
			'brand' => $brand,
			'mediaKits' => $brand->mediaKits->sortByDesc('created_at')->paginate(5),
			'tags' => CompanyController::loadTags($brand),
		]);
    }
}
