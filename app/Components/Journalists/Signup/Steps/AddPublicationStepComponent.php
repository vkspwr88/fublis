<?php

namespace App\Components\Journalists\Signup\Steps;

use App\Http\Controllers;
use App\Http\Controllers\Users\PublicationController;
use App\Services\JournalistService;
use Illuminate\Support\Facades\Validator;
use Spatie\LivewireWizard\Components\StepComponent;

class AddPublicationStepComponent extends StepComponent
{
	public $searchPublicationName;
	public $showList = false;
	public $selectedPublication;
	public $publications = [];

	public $new = false;
	public $publicationName;
	public $website;
	public $location;
	public $checkedPublicationTypes = [];
	public $checkedCategories = [];

	private JournalistService $journalistService;

	public function boot()
	{
		$this->journalistService = app()->make(JournalistService::class);
	}

	public function render()
	{
		$data = [];
		if($this->new){
			$data = [
				'locations' => Controllers\Users\LocationController::getAll(),
				'categories' => Controllers\Users\CategoryController::getAll(),
				'publicationTypes' => Controllers\Users\PublicationTypeController::getAll(),
			];
		}
		else{
			if($this->searchPublicationName){
				$this->showList = true;
				$this->publications = PublicationController::search('name', $this->searchPublicationName);
			}
		}
		return view('livewire.journalists.signup-wizard.steps.add-publication', $data);
	}

	public function stepInfo(): array
	{
		return [
			'title' => 'Submit your Publication',
			'subtitle' => 'Website and location',
		];
	}

	public function setNew()
	{
		$this->new = true;
		$this->publicationName = $this->searchPublicationName;
	}

	public function rules()
	{
		return [
			'publicationName' => 'required',
			'website' => 'required|url',
			'location' => 'required',
			'checkedPublicationTypes' => 'required|array',
			'checkedPublicationTypes.*' => 'exists:publication_types,id',
			'checkedCategories' => 'required|array',
			'checkedCategories.*' => 'exists:categories,id',
		];
	}

	public function messages()
	{
		return [
			'publicationName.required' => 'Enter the :attribute.',
			'website.required' => 'Enter the :attribute.',
			'website.url' => 'Enter the valid :attribute.',
			'location.required' => 'Select the :attribute.',
			'checkedPublicationTypes.required' => 'Check the :attribute.',
			'checkedPublicationTypes.array' => 'Check atleast one :attribute.',
			'checkedPublicationTypes.*.exists' => 'Check the valid :attribute.',
			'checkedCategories.required' => 'Check the :attribute.',
			'checkedCategories.array' => 'Check atleast one :attribute.',
			'checkedCategories.*.exists' => 'Check the valid :attribute.',
		];
	}

	public function validationAttributes()
	{
		return [
			'publicationName' => 'publication name',
			'website' => 'website url',
			'location' => 'location',
			'checkedPublicationTypes' => 'publication type',
			'checkedCategories' => 'category',
		];
	}

	public function data()
	{
		return [
			'publicationName' => $this->publicationName,
			'website' => 'http://' . $this->website,
			'location' => $this->location,
			'checkedPublicationTypes' => $this->checkedPublicationTypes,
			'checkedCategories' => $this->checkedCategories,
		];
	}

	public function add()
	{
		$validated = $this->new ?
						Validator::make($this->data(), $this->rules(), $this->messages(), $this->validationAttributes())->validate() :
						$this->validate(
							['selectedPublication' => 'required|exists:publications,id'],
							[
								'selectedPublication.required' => 'Select the publication.',
								'selectedPublication.exists' => 'Select the valid publication.',
							]
						);
		//dd($validated);
		$this->nextStep();
		$this->dispatch('alert', [
			'type' => 'success',
			'message' => 'You have successfully added your publication.'
		]);
		//return;
		/* if($this->journalistService->addCompany($validated)){
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
		]); */
	}
}
