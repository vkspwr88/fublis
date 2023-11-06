<?php

namespace App\Components\Architects\Signup\Steps;

use App\Http\Controllers;
use App\Services\ArchitectService;
use Illuminate\Support\Facades\Validator;
use Spatie\LivewireWizard\Components\StepComponent;

class AddCompanyStepComponent extends StepComponent
{
	public $companyName;
	public $website;
	public $location;
	public $category;
	public $teamSize;
	public $position;

	private ArchitectService $architectService;

	public function boot()
	{
		$this->architectService = app()->make(ArchitectService::class);
	}

	public function render()
	{
		return view('livewire.architects.signup-wizard.steps.add-company', [
			//'companies' => Controllers\Users\CompanyController::getAll(),
			'locations' => Controllers\Users\LocationController::getAll(),
			'categories' => Controllers\Users\CategoryController::getAll(),
			'teamSizes' => Controllers\Users\TeamSizeController::getAll(),
			'positions' => Controllers\Users\Architects\PositionController::getAll(),
		]);
	}

	public function stepInfo(): array
	{
		return [
			'title' => 'Add your company',
			'subtitle' => 'Add your company name & location',
		];
	}

	/* protected function prepareForValidation(): void
	{
		$this->merge([
			'website' => 'http://' . $this->website,
		]);
	} */

	public function rules()
	{
		return [
			'companyName' => 'required',
			'website' => 'required|url',
			'location' => 'required',
			'category' => 'required',
			'teamSize' => 'required',
			'position' => 'required',
		];
	}

	public function messages()
	{
		return [
			'companyName.required' => 'Enter the :attribute.',
			'website.required' => 'Enter the :attribute.',
			'website.url' => 'Enter the valid :attribute.',
			'location.required' => 'Enter the :attribute.',
			'category.required' => 'Enter the :attribute.',
			'teamSize.required' => 'Enter the :attribute.',
			'position.required' => 'Enter the :attribute.',
		];
	}

	public function validationAttributes()
	{
		return [
			'companyName' => 'company name',
			'website' => 'website url',
			'location' => 'location',
			'category' => 'category',
			'teamSize' => 'team size',
			'position' => 'position',
		];
	}

	public function data()
	{
		return [
			'companyName' => $this->companyName,
			'website' => 'http://' . $this->website,
			'location' => $this->location,
			'category' => $this->category,
			'teamSize' => $this->teamSize,
			'position' => $this->position,
		];
	}

	public function add()
	{
		/* $this->merge([
			'website' => 'http://' . $this->website,
		]); */
		$validated = Validator::make($this->data(), $this->rules(), $this->messages(), $this->validationAttributes())->validate();
		//dd($validated);
		$validated['password'] = $this->state()->guest()['password'];
		if($this->architectService->addCompany($validated)){
			$this->nextStep();
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully created your company.'
			]);
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in adding company. Please contact support.'
		]);
	}
}
