<?php

namespace App\Components\Journalists\Signup\Steps;

use App\Http\Controllers;
use App\Http\Controllers\Users\PublicationController;
use App\Interfaces\UserRepositoryInterface;
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
	//public $location;
	public $selectedCountry;
	public $selectedState;
	public $selectedCity;
	public $checkedLanguage = [];
	public $checkedPublishFrom = [];
	public $checkedPublicationTypes = [];
	public $checkedCategories = [];

	public $languages;

	private JournalistService $journalistService;
	private UserRepositoryInterface $userRepository;

	public function boot()
	{
		$this->journalistService = app()->make(JournalistService::class);
		$this->userRepository = app()->make(UserRepositoryInterface::class);
	}

	public function mount()
	{
		session()->forget('initial_state');
		$this->selectedCountry = 101;
		$this->selectedState = 0;
		if(checkInvitation('journalist')){
			$invitation = session()->get('invitation');
			$invitedUser = $this->userRepository->getInvitedJournalistUserById($invitation->invited_by);
			$this->searchPublicationName = $invitedUser->journalist->publications[0]->name;
			$this->selectedPublication = $invitedUser->journalist->publications[0]->id;
		}
		$this->languages = Controllers\Users\LanguageController::getAll();
		$this->checkedLanguage[] = Controllers\Users\LanguageController::findByName('english')->id;
	}

	public function render()
	{
		$data = [];
		if($this->new){
			$data = [
				//'locations' => Controllers\Users\LocationController::getAll(),
				'categories' => Controllers\Users\CategoryController::getAll(),
				// 'languages' => Controllers\Users\LanguageController::getAll(),
				'publishFrom' => Controllers\Users\PublishFromController::getAll(),
				'publicationTypes' => Controllers\Users\PublicationTypeController::getAll(),
				'countries' => Controllers\Users\LocationController::getCountries(),
				'states' => Controllers\Users\LocationController::getStatesByCountryId($this->selectedCountry),
				'cities' => Controllers\Users\LocationController::getCitiesByStateId($this->selectedState),
			];
			
		}
		else{
			if($this->searchPublicationName){
				$this->showList = true;
				$this->publications = PublicationController::search('name', $this->searchPublicationName);
			}
			else{
				$this->publications = collect([]);
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
			//'location' => 'required',
			'selectedCountry' => 'required|exists:countries,id',
			'selectedState' => 'required|exists:states,id',
			'selectedCity' => 'required|exists:cities,name',
			'checkedLanguage' => 'required|array',
			'checkedLanguage.*' => 'exists:languages,id',
			'checkedPublishFrom' => 'required|array',
			'checkedPublishFrom.*' => 'exists:publish_froms,id',
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
			//'location.required' => 'Select the :attribute.',
			'selectedCountry.required' => 'Select the :attribute.',
			'selectedState.required' => 'Select the :attribute.',
			'selectedCity.required' => 'Select the :attribute.',
			'checkedLanguage.required' => 'Check the :attribute.',
			'checkedPublishFrom.required' => 'Check the :attribute.',
			'checkedPublicationTypes.required' => 'Check the :attribute.',
			// 'checkedPublicationTypes.array' => 'Check atleast one :attribute.',
			// 'checkedPublicationTypes.*.exists' => 'Check the valid :attribute.',
			'checkedCategories.required' => 'Check the :attribute.',
			// 'checkedCategories.array' => 'Check atleast one :attribute.',
			'*.array' => 'Check atleast one :attribute.',
			'*.exists' => 'Select the valid :attribute.',
			'*.*.exists' => 'Check the valid :attribute.',
		];
	}

	public function validationAttributes()
	{
		return [
			'publicationName' => 'publication name',
			'website' => 'website url',
			//'location' => 'location',
			'selectedCountry' => 'country',
			'selectedState' => 'state',
			'selectedCity' => 'city',
			'checkedLanguage' => 'language',
			'checkedPublishFrom' => 'publish from',
			'checkedPublicationTypes' => 'publication type',
			'checkedCategories' => 'category',
		];
	}

	public function data()
	{
		return [
			'publicationName' => $this->publicationName,
			'website' => 'http://' . $this->website,
			//'location' => $this->location,
			'selectedCountry' => $this->selectedCountry,
			'selectedState' => $this->selectedState,
			'selectedCity' => $this->selectedCity,
			'checkedLanguage' => $this->checkedLanguage,
			'checkedPublishFrom' => $this->checkedPublishFrom,
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
		$this->website = 'http://' . $this->website;
		$this->nextStep();
		if($this->new){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully added your publication.'
			]);
		}
	}
}
