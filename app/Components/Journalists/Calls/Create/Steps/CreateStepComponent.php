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
	public $location;
	public $publication;
	public $language;
	public $submissionEndsDate;
	//public $data = [];

	public function render()
	{
		return view('livewire.journalists.calls.create-wizard.steps.create', [
			'categories' => CategoryController::getAll(),
			'locations' => LocationController::getAll(),
			'publications' => auth()->user()
									->journalist
									->publications,
			'languages' => LanguageController::getAll(),
		]);
	}

	public function rules()
    {
        return [
            'category' => 'required|exists:categories,id',
			'title' => 'required|min:8|max:80',
			'description' => 'required|min:50|max:275',
            'location' => 'required|exists:locations,id',
            'publication' => 'required|exists:publications,id',
            'language' => 'required|exists:languages,id',
			'submissionEndsDate' => 'required|date_format:d/m/y|after:tomorrow',
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
            'location.required' => 'Select the :attribute.',
            'publication.required' => 'Select the :attribute.',
            'language.required' => 'Select the :attribute.',
            'submissionEndsDate.required' => 'Select the :attribute.',
            'submissionEndsDate.date_format' => 'Enter the :attribute in dd/mm/yy format.',
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
            'location' => 'location',
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
