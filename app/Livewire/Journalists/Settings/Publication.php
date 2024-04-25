<?php

namespace App\Livewire\Journalists\Settings;

use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\JournalistPositionController;
use App\Http\Controllers\Users\LanguageController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\PublicationController;
use App\Http\Controllers\Users\PublicationTypeController;
use App\Http\Controllers\Users\PublishFromController;
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
	// #[Rule('nullable|image|mimes:svg,png,jpg,gif|max:3100|dimensions:max_width=400,max_height=400')]
	public $profileImage;
	public $position;
	// public $location;
	public $selectedCountry;
	public $countries;
	public $selectedState;
	public $states;
	public $selectedCity;
	public $cities;
	public $selectedCategories = [];
	public $selectedLanguages = [];
	public $selectedPublishFrom = [];
	public $selectedPublicationTypes = [];
	public $monthlyVisitors;
	public $aboutMe;
	public int $aboutMeLength;
	public $startingYear;
	public $isNew = true;
	public $publications;
	public $selectedPublication;

	public $languages;
	public $positions;
	public $categories;
	public $publishFrom;
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
		$this->publishFrom = PublishFromController::getAll();
		$this->publicationTypes = PublicationTypeController::getAll();
		$this->countries = LocationController::getCountries();
		$this->characterCount();
	}

	public function render()
    {
		$this->publications = PublicationController::loadModel(auth()->user()->journalist->publications);
		$this->states = LocationController::getStatesByCountryId($this->selectedCountry);
		$this->cities = LocationController::getCitiesByStateId($this->selectedState);
		return view('livewire.journalists.settings.publication');
    }

	public function characterCount()
	{
		$this->aboutMeLength = 275 - str()->length($this->aboutMe);
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
			'website' => 'required|url:https',
			'profileImage' => __('validations/rules.profileImage') . '|' . __('validations/rules.imageMimes'),
			// 'profileImage' => 'nullable|image|mimes:svg,png,jpg,gif|max:3100|dimensions:max_width=400,max_height=400',
			// 'language' => 'required|exists:languages,id',
			'position' => 'required|exists:journalist_positions,id',
			// 'location' => 'required|exists:locations,id',
			'selectedCountry' => 'required|exists:countries,id',
			'selectedState' => 'required|exists:states,id',
			'selectedCity' => 'required|exists:cities,name',
			'selectedCategories' => 'required',
			'selectedCategories.*' => 'exists:categories,id',
			'selectedLanguages' => 'required',
			'selectedLanguages.*' => 'exists:languages,id',
			'selectedPublishFrom' => 'required',
			'selectedPublishFrom.*' => 'exists:publish_froms,id',
			'selectedPublicationTypes' => 'required',
			'selectedPublicationTypes.*' => 'exists:publication_types,id',
			'monthlyVisitors' => 'nullable|string',
			'aboutMe' => 'required|max:275',
			'startingYear' => 'nullable|integer|min:1900|max:' . date('Y') . '|digits:4',
		];
	}

	public function messages()
	{
		return [
			'publicationName.required' => 'Enter the :attribute.',
			'publicationName.unique' => 'Enter the unique :attribute.',
			'website.required' => 'Enter the :attribute.',
			'website.url' => 'Enter the valid https :attribute.',
			'profileImage.image' => __('validations/messages.image'),
			'profileImage.mimes' => __('validations/messages.imageMimes'),
			'profileImage.max' => __('validations/messages.profileImage.max'),
			'profileImage.dimensions' => __('validations/messages.profileImage.dimensions'),
			// 'language.required' => 'Select the :attribute.',
			// 'language.exists' => 'Select the valid :attribute.',
			'position.required' => 'Select the :attribute.',
			// 'position.exists' => 'Select the valid :attribute.',
			// 'location.required' => 'Select the :attribute.',
			// 'location.exists' => 'Select the valid :attribute.',
			'selectedCountry.required' => 'Select the :attribute.',
			'selectedState.required' => 'Select the :attribute.',
			'selectedCity.required' => 'Select the :attribute.',
			'selectedCategories.required' => 'Select the :attribute.',
			'selectedLanguages.required' => 'Select the :attribute.',
			'selectedPublishFrom.required' => 'Select the :attribute.',
			'selectedPublicationTypes.required' => 'Select the :attribute.',
			'aboutMe.required' => 'Enter the :attribute.',
			'aboutMe.max' => 'The :attribute allows only 275 characters.',
			'startingYear.date_format' => 'Enter the :attribute in 4 digit year format.',
			'*.exists' => 'Select the valid :attribute.',
			'*.*.exists' => 'Select the valid :attribute.',
		];
	}

	public function validationAttributes()
	{
		return [
			'publicationName' => 'publication name',
			'website' => 'publication website',
			'profileImage' => 'publication logo',
			// 'language' => 'language',
			'position' => 'role',
			// 'location' => 'location',
			'selectedCountry' => 'country',
			'selectedState' => 'state',
			'selectedCity' => 'city',
			'selectedCategories' => 'category',
			'selectedLanguages' => 'language',
			'selectedPublishFrom' => 'publish from',
			'selectedPublicationTypes' => 'publication type',
			'aboutMe' => 'publication details',
			'startingYear' => 'starting year',
		];
	}

	public function data()
	{
		return [
			'publicationName' => $this->publicationName,
			'website' => 'https://' . trimWebsiteUrl($this->website),
			'profileImage' => $this->profileImage,
			// 'language' => $this->language,
			'position' => $this->position,
			// 'location' => $this->location,
			'selectedCountry' => $this->selectedCountry,
			'selectedState' => $this->selectedState,
			'selectedCity' => $this->selectedCity,
			'selectedCategories' => $this->selectedCategories,
			'selectedLanguages' => $this->selectedLanguages,
			'selectedPublishFrom' => $this->selectedPublishFrom,
			'selectedPublicationTypes' => $this->selectedPublicationTypes,
			'monthlyVisitors' => $this->monthlyVisitors,
			'aboutMe' => $this->aboutMe,
			'startingYear' => $this->startingYear,
		];
	}

	public function edit(string $publicationId)
	{
		$this->isNew = false;
		$this->selectedPublication = $this->publications->find($publicationId);
		$this->publicationName = $this->selectedPublication->name;
		$this->website = $this->selectedPublication->website;
		// $this->location = $publication->location_id;
		$this->position = JournalistPublication::where([
													'publication_id' => $publicationId,
													'journalist_id' => auth()->user()->journalist->id,
												])
												->first()
												->journalist_position_id;
		$this->selectedLanguages = $this->selectedPublication->languages->pluck('id');
		$this->selectedCategories = $this->selectedPublication->categories->pluck('id');
		$this->selectedPublishFrom = $this->selectedPublication->publishFrom->pluck('id');
		$this->selectedPublicationTypes = $this->selectedPublication->publicationTypes->pluck('id');
		$this->monthlyVisitors = $this->selectedPublication->monthly_visitors;
		$this->aboutMe = $this->selectedPublication->about_me;
		$this->startingYear = $this->selectedPublication->starting_year;
		$this->profileImageOld = $this->selectedPublication->profileImage;
		$this->publicationId = $publicationId;
		$city = LocationController::getCityByCityName($this->selectedPublication->location->name);
		$this->selectedCity = $city->name;
		$this->selectedState = $city->state->id;
		$this->selectedCountry = $city->state->country->id;
		$this->characterCount();
	}

	public function add()
	{
		$this->isNew = true;
		$this->publicationName = '';
		$this->website = '';
		// $this->location = '';
		$this->selectedLanguages = [];
		$this->position = '';
		$this->selectedCategories = [];
		$this->selectedPublicationTypes = [];
		$this->selectedPublishFrom = [];
		$this->monthlyVisitors = '';
		$this->aboutMe = '';
		$this->publicationId = '';
		$this->profileImageOld = '';
		$this->profileImage = '';
		$this->startingYear = '';
		$this->resetValidation();
		// $this->mount();
		// $this->render();
		$this->selectedCountry = 101;
		$this->selectedState = 0;
		$this->selectedPublication = collect([]);
		$this->characterCount();
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
