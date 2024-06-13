<?php

namespace App\Livewire\Architects\Settings;

use App\Http\Controllers\Users\LocationController;
use App\Services\Architects\SettingService;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule as ValidationRule;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Company extends Component
{
    use WithFileUploads;

	// #[Rule('nullable|image|mimes:svg,png,jpg,gif|max:3100|dimensions:max_width=400,max_height=400')]
	public $profileImageOld;
	public $profileImage;
	public $company;
	public $website;
	public $twitter;
	public $facebook;
	public $instagram;
	public $linkedin;
	// public $location;
	public $selectedCountry;
	// public $selectedState;
	// public $selectedCity;
	public $aboutMe;
	public int $aboutMeLength;

	private SettingService $settingService;

	public function mount()
	{
		$company = auth()->user()->architect->company->load(['profileImage', 'location']);
		$this->company = $company->name;
		$this->website = $company->website;
		$this->twitter = $company->twitter;
		$this->facebook = $company->facebook;
		$this->instagram = $company->instagram;
		$this->linkedin = $company->linkedin;
		// $this->location = $company->location_id;
		$this->aboutMe = $company->about_me;
		$this->profileImageOld = $company->profileImage;
		$this->resetValidation();
		$this->characterCount();
		$this->selectedCountry = 101;
		$this->selectedState = 0;
		if($company->location){
			$city = LocationController::getCityByCityName($company->location->name);
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
        return view('livewire.architects.settings.company', [
			// 'locations' => LocationController::getAll(),
			'countries' => LocationController::getCountries(),
			// 'states' => LocationController::getStatesByCountryId($this->selectedCountry),
			// 'cities' => LocationController::getCitiesByStateId($this->selectedState),
		]);
    }

	public function characterCount()
	{
		$this->aboutMeLength = 275 - str()->length($this->aboutMe);
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
			'company' => [
				'required',
				ValidationRule::unique('companies', 'name')
								->where(fn (Builder $query) => $query->where('name', '!=', $this->company)),
			],
			'website' => 'required|url:https',
			'profileImage' => __('validations/rules.profileImage') . '|' . __('validations/rules.imageMimes'),
			// 'profileImage' => 'nullable|image|mimes:svg,png,jpg,gif|max:3100|dimensions:max_width=400,max_height=400',
			// 'location' => 'required|exists:locations,id',
			'selectedCountry' => 'required|exists:countries,id',
			// 'selectedState' => 'required|exists:states,id',
			// 'selectedCity' => 'required|exists:cities,name',
			'aboutMe' => 'required|max:275',
			'twitter' => 'nullable',
			'facebook' => 'nullable',
			'instagram' => 'nullable',
			'linkedin' => 'nullable',
		];
	}

	public function messages()
	{
		return [
			'company.required' => 'Enter the :attribute.',
			'company.unique' => 'Enter the unique :attribute.',
			'website.required' => 'Enter the :attribute.',
			'website.url' => 'Enter the valid https :attribute.',
			// 'profileImage.required' => 'Upload the :attribute.',
			/* 'profileImage.image' => 'The :attribute supports only image.',
			'profileImage.mimes' => 'The :attribute supports only svg, png, jpg or gif.',
			'profileImage.max' => 'Maximum allowed size to upload :attribute 3MB.',
			'profileImage.dimensions' => 'Maximum allowed dimension for the :attribute is 400x400px.', */
			'profileImage.image' => __('validations/messages.image'),
			'profileImage.mimes' => __('validations/messages.imageMimes'),
			'profileImage.max' => __('validations/messages.profileImage.max'),
			'profileImage.dimensions' => __('validations/messages.profileImage.dimensions'),
			// 'location.required' => 'Select the :attribute.',
			// 'location.exists' => 'Select the valid :attribute.',
			'selectedCountry.required' => 'Select the :attribute.',
			// 'selectedState.required' => 'Select the :attribute.',
			// 'selectedCity.required' => 'Select the :attribute.',
			'aboutMe.required' => 'Enter the :attribute.',
			'aboutMe.max' => 'The :attribute allows only 275 characters.',
			'*.exists' => 'Select the valid :attribute.',
		];
	}

	public function validationAttributes()
	{
		return [
			'company' => 'company name',
			'website' => 'company website',
			'profileImage' => 'company logo',
			// 'location' => 'location',
			'selectedCountry' => 'country',
			// 'selectedState' => 'state',
			// 'selectedCity' => 'city',
			'aboutMe' => 'company details',
		];
	}

	public function data()
	{
		return [
			'company' => $this->company,
			'website' => 'https://' . trimWebsiteUrl($this->website),
			'profileImage' => $this->profileImage,
			'twitter' => $this->twitter ? $this->twitter : '',
			'facebook' => $this->facebook ? $this->facebook : '',
			'instagram' => $this->instagram ? $this->instagram : '',
			'linkedin' => $this->linkedin ? $this->linkedin : '',
			// 'location' => $this->location,
			'selectedCountry' => $this->selectedCountry,
			// 'selectedState' => $this->selectedState,
			// 'selectedCity' => $this->selectedCity,
			'aboutMe' => $this->aboutMe,
		];
	}

	public function refresh()
	{
		$this->mount();
	}

	public function update()
	{
		$validated = Validator::make($this->data(), $this->rules(), $this->messages(), $this->validationAttributes())->validate();
		if(!$this->profileImageOld && !$this->profileImage){
			$this->addError('profileImage', 'Upload company logo.');
			return;
		}
		//dd($validated);
		if($this->settingService->updateCompany($validated)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully updated the company details.'
			]);
			return;
			//return to_route('architect.account.profile.setting.company');
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in updating the company details. Please try again or contact support.'
		]);
	}
}
