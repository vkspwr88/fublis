<?php

namespace App\Components\Architects\Signup\Steps;

use App\Http\Controllers;
use App\Interfaces\UserRepositoryInterface;
use App\Services\ArchitectService;
use Illuminate\Support\Facades\Validator;
use Spatie\LivewireWizard\Components\StepComponent;

class AddCompanyStepComponent extends StepComponent
{
	public $searchCompanyName;
	public $showList = false;
	public $selectedCompany;

	public $new = false;
	public $companyName;
	public $website;
	public $location;
	public $selectedCountry;
	// public $selectedState;
	// public $selectedCity;
	public $selectedCategory;
	public $selectedTeamSize;
	public $selectedPosition;

	private ArchitectService $architectService;
	private UserRepositoryInterface $userRepository;

	public function boot()
	{
		$this->architectService = app()->make(ArchitectService::class);
		$this->userRepository = app()->make(UserRepositoryInterface::class);
	}

	public function mount()
	{
		//$this->countries = Controllers\Users\LocationController::getCountries();
		session()->forget('initial_state');
		$this->selectedCountry = 'india';
		// $this->selectedState = 0;
		if(checkInvitation('architect')){
			$invitation = session()->get('invitation');
			$invitedUser = $this->userRepository->getInvitedArchitectUserById($invitation->invited_by);
			//dd($invitation, $invitedUser);
			$this->searchCompanyName = $invitedUser->architect->company->name;
			$this->selectedCompany = $invitedUser->architect->company->id;

			/* $this->companyName = $invitedUser->architect->company->name;
			$this->website = trimWebsiteUrl($invitedUser->architect->company->website);
			$this->location = $invitedUser->architect->company->location_id;
			$this->selectedCategory = $invitedUser->architect->company->category_id;
			$this->selectedTeamSize = $invitedUser->architect->company->team_size_id; */
		}
		//$this->positions = Controllers\Users\Architects\PositionController::getAll();
		//$this->getCities();
	}

	public function render()
	{
		//dd(Controllers\Users\LocationController::getCountries());
		$data = [];
		if($this->new){
			$data = [
				'locations' => Controllers\Users\LocationController::getAll(),
				'categories' => Controllers\Users\CategoryController::getAll(),
				'teamSizes' => Controllers\Users\TeamSizeController::getAll(),
				'countries' => Controllers\Users\LocationController::getCountries(),
				// 'states' => Controllers\Users\LocationController::getStatesByCountryId($this->selectedCountry),
				// 'cities' => Controllers\Users\LocationController::getCitiesByStateId($this->selectedState),
			];
			//$this->countries = Controllers\Users\LocationController::getCountries();
			//$this->getCities();
		}
		else{
			if($this->searchCompanyName){
				$this->showList = true;
				$data['companies'] = Controllers\Users\CompanyController::search('name', $this->searchCompanyName);
			}
			else{
				$data['companies'] = collect([]);
			}
		}
		//$this->positions = Controllers\Users\Architects\PositionController::getAll();
		$data['positions'] = Controllers\Users\Architects\PositionController::getAll();
		return view('livewire.architects.signup-wizard.steps.add-company', $data);
	}

	public function stepInfo(): array
	{
		return [
			'title' => 'Add your company',
			'subtitle' => 'Add your company name & location',
		];
	}

	public function setNew()
	{
		$this->new = true;
		$this->companyName = $this->searchCompanyName;
	}

	public function rules()
	{
		return [
			'companyName' => 'required',
			'website' => 'required|url:https',
			'selectedCountry' => 'required|exists:countries,name',
			// 'selectedState' => 'required|exists:states,id',
			// 'selectedCity' => 'required|exists:cities,name',
			//'location' => 'required',
			'selectedCategory' => 'required|exists:categories,id',
			'selectedTeamSize' => 'required|exists:team_sizes,id',
			'selectedPosition' => 'required|exists:architect_positions,id',
		];
	}

	public function messages()
	{
		return [
			'companyName.required' => 'Enter the :attribute.',
			'website.required' => 'Enter the :attribute.',
			'website.url' => 'Enter the valid https :attribute.',
			//'location.required' => 'Select the :attribute.',
			'selectedCountry.required' => 'Select the :attribute.',
			// 'selectedState.required' => 'Select the :attribute.',
			// 'selectedCity.required' => 'Select the :attribute.',
			'selectedCategory.required' => 'Select the :attribute.',
			'selectedTeamSize.required' => 'Select the :attribute.',
			'selectedPosition.required' => 'Select the :attribute.',
			'*.exists' => 'Select the valid :attribute.',
		];
	}

	public function validationAttributes()
	{
		return [
			'companyName' => 'company name',
			'website' => 'website url',
			//'location' => 'location',
			'selectedCountry' => 'country',
			// 'selectedState' => 'state',
			// 'selectedCity' => 'city',
			'selectedCategory' => 'category',
			'selectedTeamSize' => 'team size',
			'selectedPosition' => 'position',
		];
	}

	public function data()
	{
		return [
			'companyName' => $this->companyName,
			'website' => 'https://' . trimWebsiteUrl($this->website),
			//'location' => $this->location,
			'selectedCountry' => $this->selectedCountry,
			// 'selectedState' => $this->selectedState,
			// 'selectedCity' => $this->selectedCity,
			'selectedCategory' => $this->selectedCategory,
			'selectedTeamSize' => $this->selectedTeamSize,
			'selectedPosition' => $this->selectedPosition,
		];
	}

	public function add()
	{
		$validated = $this->new ?
							Validator::make($this->data(), $this->rules(), $this->messages(), $this->validationAttributes())->validate() :
							$this->validate(
								[
									'selectedCompany' => 'required|exists:companies,id',
									'selectedPosition' => 'required|exists:architect_positions,id',
								],
								[
									'*.required' => 'Select the :attribute.',
									'*.exists' => 'Select the valid :attribute.',
								],
								[
									'selectedCompany' => 'company',
									'selectedPosition' => 'position',
								]
							);
		$validated['password'] = $this->state()->guest()['password'];
		$validated['new'] = $this->new;
		//dd($validated);
		if(!$this->new){
			if($this->architectService->checkCompanyArchitectsLimit($this->selectedCompany)){
				$this->dispatch('alert', [
					'type' => 'warning',
					'message' => 'Please upgrade your plan to add more users.'
				]);
				return;
			}
		}
		if($this->architectService->addCompany($validated)){
			$this->nextStep();
			if($this->new){
				$this->dispatch('alert', [
					'type' => 'success',
					'message' => 'You have successfully added your company.'
				]);
			}
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in adding company. Please contact support.'
		]);
	}
}
