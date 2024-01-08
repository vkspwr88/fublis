<?php

namespace App\Components\Journalists\Calls\Create\Steps;

use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\LanguageController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\PublicationController;
use Spatie\LivewireWizard\Components\StepComponent;

class CreateStepComponent extends StepComponent
{
	public $category;
	public $title;
	public $description;
	//public $location;
	public $selectedCountry;
	public $selectedCity;
	public $publication;
	public $language;
	public $submissionEndsDate;
	public int $descriptionTextLength;
	public int $titleTextLength;
	//public $data = [];

	public function render()
	{
		return view('livewire.journalists.calls.create-wizard.steps.create', [
			'categories' => CategoryController::getAll(),
			// 'locations' => LocationController::getAll(),
			'countries' => LocationController::getCountries(),
			'cities' => LocationController::getCitiesByCountry($this->selectedCountry)->sortBy('name'),
			'publications' => auth()->user()
									->journalist
									->publications,
			'languages' => LanguageController::getAll(),
		]);
	}

	public function mount()
	{
		$this->characterCount();
		$this->selectedCountry = 101;
	}

	public function characterCount()
	{
		$this->descriptionTextLength = 275 - str()->length($this->description);
		$this->titleTextLength = 80 - str()->length($this->title);
	}

	public function rules()
    {
        return [
            'category' => 'required|exists:categories,id',
			'title' => 'required|min:8|max:80',
			'description' => 'required|max:275',
			// 'description' => 'required|min:50|max:275',
            // 'location' => 'required|exists:locations,id',
			'selectedCountry' => 'required|exists:countries,id',
			'selectedCity' => 'required|exists:cities,name',
            'publication' => 'required|exists:publications,id',
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
			'title.max' => 'The :attribute is limited 275 characters.',
            // 'location.required' => 'Select the :attribute.',
			'selectedCountry.required' => 'Select the :attribute.',
			'selectedCity.required' => 'Select the :attribute.',
            'publication.required' => 'Select the :attribute.',
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
			'selectedCity' => 'city',
            'publication' => 'publication title',
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
