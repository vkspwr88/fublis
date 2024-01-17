<?php

namespace App\Livewire\Journalists\Settings;

use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\JournalistPositionController;
use App\Http\Controllers\Users\LanguageController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\PublicationTypeController;
use App\Models\JournalistPublication;
use App\Services\Journalists\SettingService;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule as ValidationRule;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Publication extends Component
{
	use WithFileUploads;

	public $publicationId;
	public $publicationName;
	public $website;
	public $profileImageOld;
	#[Rule('nullable|image|mimes:svg,png,jpg,gif|max:3100|dimensions:max_width=400,max_height=400')]
	public $profileImage;
	public $language;
	public $position;
	// public $location;
	public $selectedCountry;
	public $countries;
	public $selectedState;
	public $states;
	public $selectedCity;
	public $cities;
	public $selectedCategories = [];
	public $selectedPublicationTypes = [];
	public $aboutMe;
	public $isNew = true;
	public $publications;
	public $selectedPublication;

	public $languages;
	public $positions;
	public $categories;
	public $publicationTypes;

	private SettingService $settingService;

	public function mount()
	{
		$this->selectedCountry = 101;
		$this->selectedState = 0;
		$this->selectedPublication = collect([]);
		$this->languages = LanguageController::getAll();
		$this->positions = JournalistPositionController::getAll();
		$this->categories = CategoryController::getAll();
		$this->publicationTypes = PublicationTypeController::getAll();
		$this->countries = LocationController::getCountries();
	}

	public function render()
    {
		$this->publications = auth()->user()->journalist->publications->load(['profileImage', 'categories', 'publicationTypes', 'location']);
		$this->states = LocationController::getStatesByCountryId($this->selectedCountry);
		$this->cities = LocationController::getCitiesByStateId($this->selectedState);
		return view('livewire.journalists.settings.publication');
    }

	public function boot()
	{
		$this->settingService = app()->make(SettingService::class);
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
			'publicationName' => [
				'required',
				ValidationRule::unique('publications', 'name')
								->where(fn (Builder $query) => $query->where('name', '!=', $this->publicationName)),
			],
			'website' => 'required|url',
			'profileImage' => 'nullable|image|mimes:svg,png,jpg,gif|max:3100|dimensions:max_width=400,max_height=400',
			'language' => 'required|exists:languages,id',
			'position' => 'required|exists:journalist_positions,id',
			// 'location' => 'required|exists:locations,id',
			'selectedCountry' => 'required|exists:countries,id',
			'selectedState' => 'required|exists:states,id',
			'selectedCity' => 'required|exists:cities,name',
			'selectedCategories' => 'required',
			'selectedCategories.*' => 'exists:categories,id',
			'selectedPublicationTypes' => 'required',
			'selectedPublicationTypes.*' => 'exists:publication_types,id',
			'aboutMe' => 'required|max:275',
		];
	}

	public function messages()
	{
		return [
			'publicationName.required' => 'Enter the :attribute.',
			'publicationName.unique' => 'Enter the unique :attribute.',
			'website.required' => 'Enter the :attribute.',
			'website.url' => 'Enter the valid :attribute.',
			'profileImage.required' => 'Upload the :attribute.',
			'profileImage.image' => 'The :attribute supports only image.',
			'profileImage.mimes' => 'The :attribute supports only svg, png, jpg or gif.',
			'profileImage.max' => 'Maximum allowed size to upload :attribute 3MB.',
			'profileImage.dimensions' => 'Maximum allowed dimension for the :attribute is 400x400px.',
			'language.required' => 'Select the :attribute.',
			// 'language.exists' => 'Select the valid :attribute.',
			'position.required' => 'Select the :attribute.',
			// 'position.exists' => 'Select the valid :attribute.',
			// 'location.required' => 'Select the :attribute.',
			// 'location.exists' => 'Select the valid :attribute.',
			'selectedCountry.required' => 'Select the :attribute.',
			'selectedState.required' => 'Select the :attribute.',
			'selectedCity.required' => 'Select the :attribute.',
			'selectedCategories.required' => 'Select the :attribute.',
			'selectedPublicationTypes.required' => 'Select the :attribute.',
			'aboutMe.required' => 'Enter the :attribute.',
			'aboutMe.max' => 'The :attribute allows only 275 characters.',
			'*.exists' => 'Select the valid :attribute.',
		];
	}

	public function validationAttributes()
	{
		return [
			'publicationName' => 'publication name',
			'website' => 'publication website',
			'profileImage' => 'publication logo',
			'language' => 'language',
			'position' => 'role',
			// 'location' => 'location',
			'selectedCountry' => 'country',
			'selectedState' => 'state',
			'selectedCity' => 'city',
			'selectedCategories' => 'category',
			'selectedPublicationTypes' => 'publication type',
			'aboutMe' => 'publication details',
		];
	}

	public function data()
	{
		return [
			'publicationName' => $this->publicationName,
			'website' => 'http://' . $this->website,
			'profileImage' => $this->profileImage,
			'language' => $this->language,
			'position' => $this->position,
			// 'location' => $this->location,
			'selectedCountry' => $this->selectedCountry,
			'selectedState' => $this->selectedState,
			'selectedCity' => $this->selectedCity,
			'selectedCategories' => $this->selectedCategories,
			'selectedPublicationTypes' => $this->selectedPublicationTypes,
			'aboutMe' => $this->aboutMe,
		];
	}

	public function edit(string $publicationId)
	{
		$this->isNew = false;
		$this->selectedPublication = $this->publications->find($publicationId);
		$this->publicationName = $this->selectedPublication->name;
		$this->website = trimWebsiteUrl($this->selectedPublication->website);
		// $this->location = $publication->location_id;
		$this->position = JournalistPublication::where([
													'publication_id' => $publicationId,
													'journalist_id' => auth()->user()->journalist->id,
												])
												->first()
												->journalist_position_id;
		$this->language = $this->selectedPublication->language_id;
		$this->selectedCategories = $this->selectedPublication->categories->pluck('id');
		$this->selectedPublicationTypes = $this->selectedPublication->publicationTypes->pluck('id');
		$this->aboutMe = $this->selectedPublication->about_me;
		$this->profileImageOld = $this->selectedPublication->profileImage;
		$this->publicationId = $publicationId;
		$city = LocationController::getCityByCityName($this->selectedPublication->location->name);
		$this->selectedCity = $city->name;
		$this->selectedState = $city->state->id;
		$this->selectedCountry = $city->state->country->id;
	}

	public function add()
	{
		$this->isNew = true;
		$this->publicationName = '';
		$this->website = '';
		// $this->location = '';
		$this->language = '';
		$this->position = '';
		$this->selectedCategories = [];
		$this->selectedPublicationTypes = [];
		$this->aboutMe = '';
		$this->publicationId = '';
		$this->profileImageOld = '';
		$this->profileImage = '';
		$this->resetValidation();
		// $this->mount();
		// $this->render();
		$this->selectedCountry = 101;
		$this->selectedState = 0;
		$this->selectedPublication = collect([]);
	}

	public function refresh()
	{
		//$this->mount();
	}

	public function delete(string $publicationId)
	{
		if($this->settingService->deletePublication($publicationId)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully deleted the publication.'
			]);
			$this->add();
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in deleting the publication. Please try again or contact support.'
		]);
	}

	public function update()
	{
		// dd($this->selectedCity, $this->selectedState);
		//dd($this->selectedCategories);
		$validated = Validator::make($this->data(), $this->rules(), $this->messages(), $this->validationAttributes())->validate();
		if( (!$this->isNew && !$this->profileImageOld && !$this->profileImage) || ($this->isNew && !$this->profileImage) ){
			$this->addError('profileImage', 'Upload publication logo.');
			return;
		}
		$validated['new'] = $this->isNew;
		$validated['publicationId'] = $this->publicationId;
		//dd($validated);
		if($this->settingService->updatePublication($validated)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully saved the publication details.'
			]);
			$this->add();
			return;
			//return to_route('journalist.account.profile.setting.publication');
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in saving the publication details. Please try again or contact support.'
		]);
	}
}
