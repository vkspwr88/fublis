<?php

namespace App\Components\Journalists\Calls\Create\Steps;

use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\LanguageController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\PublicationController;
use App\Http\Controllers\Users\PublishFromController;
use Spatie\LivewireWizard\Components\StepComponent;

class CreateStepComponent extends StepComponent
{
	public $category;
	public $title;
	public $description;
	//public $location;
	public $selectedCountry;
	public $selectedCountryName;
	public $selectedState;
	public $selectedStateName;
	public $selectedCity;
	public $selectedPublishFrom;
	public $publication;
	public $language;
	public $submissionEndsDate;
	public int $descriptionTextLength;
	public int $titleTextLength;
	//public $data = [];
	public $categories;
	public $countries;
	public $states;
	public $cities;
	public $publications;
	public $publishFrom;
	public $languages;

	public function render()
	{
		$this->states = LocationController::getStatesByCountryId($this->selectedCountry);
		$this->cities = LocationController::getCitiesByStateId($this->selectedState);
		$this->selectedCountryName = $this->countries->find($this->selectedCountry);
		$this->selectedStateName = $this->states->find($this->selectedState);
		return view('livewire.journalists.calls.create-wizard.steps.create');
	}

	public function mount()
	{
		$this->characterCount();
		$this->selectedCountry = 101;
		$this->selectedState = 0;
		$this->categories = CategoryController::getAll();
		$this->countries = LocationController::getCountries();
		$this->publishFrom = PublishFromController::getAll();
		$this->publications = auth()->user()->journalist->publications->merge(auth()->user()->journalist->associatedPublications);
		$this->languages = LanguageController::getAll();
	}

	public function characterCount()
	{
		$this->descriptionTextLength = 2750 - str()->length($this->description);
		$this->titleTextLength = 80 - str()->length($this->title);
	}

	public function rules()
    {
        return [
            'category' => 'required|exists:categories,id',
			'title' => 'required|min:8|max:80',
			'description' => 'required|max:2750',
			// 'description' => 'required|min:50|max:2750',
            // 'location' => 'required|exists:locations,id',
			'selectedCountry' => 'required|exists:countries,id',
			'selectedState' => 'required|exists:states,id',
			'selectedCity' => 'required|exists:cities,name',
            'publication' => 'required|exists:publications,id',
            'selectedPublishFrom' => 'required|exists:publish_from,id',
            'language' => 'required|exists:languages,id',
			'submissionEndsDate' => 'required|date_format:d-M-Y|after:tomorrow',
        ];
    }

	public function messages()
    {
        return [
            'category.required' => 'Select the :attribute.',
			'title.required' => 'Enter the :attribute.',
			'title.min' => 'The :attribute must be atleast 8 characters.',
			'title.max' => 'The :attribute is limited 80 characters.',
			'description.required' => 'Enter the :attribute.',
			'title.min' => 'The :attribute must be atleast 80 characters.',
			'title.max' => 'The :attribute is limited 2750 characters.',
            // 'location.required' => 'Select the :attribute.',
			'selectedCountry.required' => 'Select the :attribute.',
			'selectedState.required' => 'Select the :attribute.',
			'selectedCity.required' => 'Select the :attribute.',
            'publication.required' => 'Select the :attribute.',
            'selectedPublishFrom.required' => 'Select the :attribute.',
            'language.required' => 'Select the :attribute.',
            'submissionEndsDate.required' => 'Select the :attribute.',
            'submissionEndsDate.date_format' => 'Enter the :attribute in 01-Jan-1990 format.',
            'submissionEndsDate.after' => 'The :attribute can be any date after tomorrow.',
            '*.exists' => 'Select the valid :attribute.',
        ];
    }

	public function validationAttributes()
    {
        return [
            'category' => 'category',
			'title' => 'title',
			'description' => 'story requirements description',
            // 'location' => 'location',
			'selectedCountry' => 'country',
			'selectedState' => 'state',
			'selectedCity' => 'city',
            'publication' => 'publication title',
            'selectedPublishFrom' => 'publish from',
            'language' => 'language',
			'submissionEndsDate' => 'submission ends date',
        ];
    }

	public function preview()
	{
		$validated = $this->validate();
		//dd($validated);
		//$this->data = $validated;
		$this->nextStep();
	}
}
