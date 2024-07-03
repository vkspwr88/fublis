<?php

namespace App\Livewire\Architects\Settings;

use App\Http\Controllers\Users\Architects\PositionController;
use App\Http\Controllers\Users\LocationController;
use App\Services\Architects\SettingService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule as ValidationRule;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class PersonalInfo extends Component
{
	use WithFileUploads;

	// #[Rule('nullable|image|mimes:svg,png,jpg,gif|max:3100|dimensions:max_width=400,max_height=400')]
	public $profileImageOld;
	#[Validate]
	public $profileImage;
	public $name;
	public $email;
	public $company;
	public $position;
	// public $location;
	public $selectedCountry;
	public $selectedState;
	public $selectedCity;
	public $aboutMe;
	public int $aboutMeLength;

	private SettingService $settingService;

	public function mount()
	{
		$architect = auth()->user()->architect->load(['company', 'profileImage', 'location']);
		$this->name = auth()->user()->name;
		$this->email = auth()->user()->email;
		$this->company = $architect->company->name;
		$this->position = $architect->architect_position_id;
		// $this->location = $architect->location_id;
		$this->aboutMe = $architect->about_me;
		$this->profileImageOld = $architect->profileImage;
		$this->characterCount();
		$this->selectedCountry = 101;
		$this->selectedState = 0;
		if($architect->location){
			$city = LocationController::getCityByCityName($architect->location->name);
			$this->selectedCity = $city->name;
			$this->selectedState = $city->state->id;
			$this->selectedCountry = $city->state->country->id;
		}
	}

	public function boot()
	{
		$this->settingService = app()->make(SettingService::class);
	}

    public function render()
    {
        return view('livewire.architects.settings.personal-info', [
			// 'locations' => LocationController::getAll(),
			'countries' => LocationController::getCountries(),
			'states' => LocationController::getStatesByCountryId($this->selectedCountry),
			'cities' => LocationController::getCitiesByStateId($this->selectedState),
			'positions' => PositionController::getAll(),
		]);
    }

	public function characterCount()
	{
		$this->aboutMeLength = 275 - str()->length($this->aboutMe);
	}

	public function refresh()
	{
		$this->mount();
		$this->resetValidation();
	}

	public function finishUpload($name, $tmpPath, $isMultiple)
    {
		$this->cleanupOldUploads();
		if ($isMultiple) {
            $file = collect($tmpPath)->map(function ($i) {
                return TemporaryUploadedFile::createFromLivewire($i);
            })->toArray();
            $this->emitSelf('upload:finished', $name, collect($file)->map->getFilename()->toArray());
        } else {
            $file = TemporaryUploadedFile::createFromLivewire($tmpPath[0]);
            $this->emitSelf('upload:finished', $name, [$file->getFilename()]);

            // If the property is an array, but the upload ISNT set to "multiple"
            // then APPEND the upload to the array, rather than replacing it.
            if (is_array($value = $this->getPropertyValue($name))) {
                $file = array_merge($value, [$file]);
            }
        }
        $this->syncInput($name, $file);
    }

	public function rules()
	{
		return [
			'name' => 'required',
			'email' => [
				'required',
				'email:rfc,dns',
				ValidationRule::unique('users')->ignore(auth()->id()),
			],
			'profileImage' => __('validations/rules.profileImage') . '|' . __('validations/rules.imageMimes'),
			// 'profileImage' => 'nullable|image|mimes:svg,png,jpg,gif|max:3100|dimensions:max_width=400,max_height=400',
			'position' => 'required|exists:architect_positions,id',
			// 'location' => 'required|exists:locations,id',
			'selectedCountry' => 'required|exists:countries,id',
			'selectedState' => 'required|exists:states,id',
			'selectedCity' => 'required|exists:cities,name',
			'aboutMe' => 'required|max:275',
		];
	}

	public function messages()
	{
		return [
			'name.required' => 'Enter the :attribute.',
			'email.required' => 'Enter the :attribute.',
			'email.email' => 'Enter valid :attribute.',
			'email.unique' => 'The :attribute is already registerred.',
			'profileImage.image' => __('validations/messages.image'),
			'profileImage.mimes' => __('validations/messages.imageMimes'),
			'profileImage.max' => __('validations/messages.profileImage.max'),
			'profileImage.dimensions' => __('validations/messages.profileImage.dimensions'),
			'position.required' => 'Select the :attribute.',
			// 'position.exists' => 'Select the valid :attribute.',
			// 'location.required' => 'Select the :attribute.',
			// 'location.exists' => 'Select the valid :attribute.',
			'selectedCountry.required' => 'Select the :attribute.',
			'selectedState.required' => 'Select the :attribute.',
			'selectedCity.required' => 'Select the :attribute.',
			'aboutMe.required' => 'Enter the :attribute.',
			'aboutMe.max' => 'The :attribute allows only 275 characters.',
			'*.exists' => 'Select the valid :attribute.',
		];
	}

	public function validationAttributes()
	{
		return [
			'name' => 'full name',
			'email' => 'amail address',
			'profileImage' => 'profile image',
			'position' => 'role',
			// 'location' => 'location',
			'selectedCountry' => 'country',
			'selectedState' => 'state',
			'selectedCity' => 'city',
			'aboutMe' => 'bio',
		];
	}

	public function update()
	{
		$validated = $this->validate($this->rules(), $this->messages(), $this->validationAttributes());
		if(!$this->profileImageOld && !$this->profileImage){
			$this->addError('profileImage', 'Upload profile image.');
			return;
		}
		//dd($validated);
		if($this->settingService->updatePersonalInfo($validated)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully updated the personal info.'
			]);
			return;
			//return to_route('architect.account.profile.setting.personal-info');
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in updating the personal info. Please try again or contact support.'
		]);
	}
}
