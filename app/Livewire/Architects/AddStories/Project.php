<?php

namespace App\Livewire\Architects\AddStories;

ini_set('max_execution_time', 300);
use App\Http\Controllers\Users\AreaController;
use App\Http\Controllers\Users\BuildingTypologyController;
use App\Http\Controllers\Users\BuildingUseController;
use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\CompanyController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\ProjectAccessController;
use App\Http\Controllers\Users\ProjectStatusController;
use App\Services\AddStoryService;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Project extends Component
{
    use WithFileUploads;

	public $projectTitle;
	public $category;
	public $siteArea;
	public $siteAreaUnit;
	public $builtUpArea;
	public $builtUpAreaUnit;
	//public $location;
	public $selectedCountry;
	public $selectedState;
	public $selectedCity;
	public $status;
	public $materials;
	public $buildingTypology;
	public $buildingUse;
	public $imageCredits;
	public $textCredits;
	public $renderCredits;
	public $consultants;
	public $designTeam;
	#[Rule('required|image|mimes:svg,png,jpg,gif|max:3100|dimensions:max_width=800,max_height=400')]
	public $coverImage;
	public $projectBrief;
	public int $projectBriefLength;
	#[Rule('nullable|file|mimes:pdf,doc,docs')]
	public $projectFile;
	public $projectLink;
	public $photographsFiles = [];
	public $drawingsFiles = [];
	public $tags = [];
	public $mediaContact;
	public $mediaKitAccess;
	public $showOtherFields;

	public $categories;
	public $areas;
	public $countries;
	public $states;
	public $cities;
	public $statuses;
	public $buildingTypologies;
	public $buildingUses;
	public $mediaContacts;
	public $projectAccess;

	private AddStoryService $addStoryService;

	public function mount()
	{
		$this->characterCount();
		$this->selectedCountry = 101;
		$this->selectedState = 0;
		/* $this->buildingTypology = '';
		$this->showOtherFields = false; */

		$this->categories = CategoryController::getAll();
		$this->areas = AreaController::getAll();
		$this->countries = LocationController::getCountries();
		$this->statuses = ProjectStatusController::getAll();
		$this->buildingTypologies = BuildingTypologyController::getAll();
		$this->mediaContacts = CompanyController::getMediaContacts();
		$this->projectAccess = ProjectAccessController::getAll();
	}

    public function render()
    {
		$this->states = LocationController::getStatesByCountryId($this->selectedCountry);
		$this->cities = LocationController::getCitiesByStateId($this->selectedState);
		$category = $this->categories->find($this->category);
		if($category && ($category->name === 'Architecture' || $category->name === 'Interior Design')){
			$this->showOtherFields = true;
			$this->buildingUses = BuildingUseController::getAllByTypologyId($this->buildingTypology);
		}
		else{
			$this->showOtherFields = false;
			$this->buildingTypology = '';
		}

		return view('livewire.architects.add-stories.project');
        /* return view('livewire.architects.add-stories.project', [
			'categories' => CategoryController::getAll(),
			'areas' => AreaController::getAll(),
			//'locations' => LocationController::getAll(),
			'countries' => LocationController::getCountries(),
			'states' => LocationController::getStatesByCountryId($this->selectedCountry),
			'cities' => LocationController::getCitiesByStateId($this->selectedState),
			// 'cities' => LocationController::getCitiesByCountry($this->selectedCountry)->sortBy('name'),
			'statuses' => ProjectStatusController::getAll(),
			'buildingTypologies' => BuildingTypologyController::getAll(),
			'mediaContacts' => CompanyController::getMediaContacts(),
			'projectAccess' => ProjectAccessController::getAll(),
		]); */
    }

	public function boot()
	{
		$this->addStoryService = app()->make(AddStoryService::class);
	}

	public function characterCount()
	{
		$this->projectBriefLength = 275 - str()->length($this->projectBrief);
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
			'projectTitle' => 'required',
			'category' => 'required',
			'siteArea' => 'nullable|numeric',
			'siteAreaUnit' => 'nullable',
			'builtUpArea' => 'nullable|numeric',
			'builtUpAreaUnit' => 'nullable',
			'materials' => 'nullable',
			'buildingTypology' => 'nullable',
			'buildingUse' => 'nullable',
			//'location' => 'required',
			'selectedCountry' => 'required|exists:countries,id',
			'selectedState' => 'required|exists:states,id',
			'selectedCity' => 'required|exists:cities,name',
			'status' => 'required',
			'imageCredits' => 'required',
			'textCredits' => 'required',
			'renderCredits' => 'required',
			'consultants' => 'required',
			'designTeam' => 'required',
			'coverImage' => 'required|image|mimes:svg,png,jpg,gif|max:3100|dimensions:max_width=800,max_height=400',
			'projectBrief' => 'required|max:275',
			'projectFile' => 'nullable|file|mimes:pdf,doc,docs',
			'projectLink' => 'nullable|required_without:projectFile|url',
			'photographsFiles' => 'required|array',
			'photographsFiles.*' => 'file|mimes:zip,svg,png,jpg,gif',
			//'photographsFiles.*' => 'image|mimes:svg,png,jpg,gif',
			'drawingsFiles' => 'required|array',
			'drawingsFiles.*' => 'file|mimes:zip,svg,png,jpg,gif',
			//'drawingsFiles.*' => 'image|mimes:svg,png,jpg,gif',
			'tags' => 'required|array',
			'mediaContact' => 'required',
			'mediaKitAccess' => 'required',
		];
	}

	public function messages()
	{
		return [
			'projectTitle.required' => 'Enter the :attribute.',
			'category.required' => 'Select the :attribute.',
			'siteArea.required' => 'Enter the :attribute.',
			'siteArea.numeric' => 'Enter the :attribute in numbers.',
			'siteAreaUnit.required' => 'Select the :attribute.',
			'builtUpArea.required' => 'Enter the :attribute.',
			'builtUpArea.numeric' => 'Enter the :attribute in numbers.',
			'builtUpAreaUnit.required' => 'Select the :attribute.',
			//'location.required' => 'Select the :attribute.',
			'selectedCountry.required' => 'Select the :attribute.',
			'selectedState.required' => 'Select the :attribute.',
			'selectedCity.required' => 'Select the :attribute.',
			'*.exists' => 'Select the valid :attribute.',
			'status.required' => 'Select the :attribute.',
			'materials.required' => 'Enter the :attribute.',
			'buildingTypology.required' => 'Select the :attribute.',
			'imageCredits.required' => 'Enter the :attribute.',
			'textCredits.required' => 'Enter the :attribute.',
			'renderCredits.required' => 'Enter the :attribute.',
			'consultants.required' => 'Enter the :attribute.',
			'designTeam.required' => 'Enter the :attribute.',
			'coverImage.required' => 'Upload the :attribute.',
			'coverImage.image' => 'The :attribute supports only image.',
			'coverImage.mimes' => 'The :attribute supports only svg, png, jpg or gif.',
			'coverImage.max' => 'Maximum allowed size to upload :attribute 3MB.',
			'coverImage.dimensions' => 'Maximum allowed dimension for the :attribute is 800x400px.',
			'projectBrief.required' => 'Enter the :attribute.',
			'projectBrief.max' => 'The :attribute allows only 275 characters.',
			'projectFile.mimes' => 'The :attribute supports only odf, doc or docs.',
			'projectLink.url' => 'Enter the valid :attribute.',
			'projectLink.required_without' => 'Enter the :attribute or upload the file.',
			'photographsFiles.required' => 'Upload the :attribute.',
			'photographsFiles.*.file' => 'The :attribute supports only file.',
			'photographsFiles.*.mimes' => 'The :attribute supports only zip, svg, png, jpg or gif.',
			'drawingsFiles.required' => 'Upload the :attribute.',
			'drawingsFiles.*.file' => 'The :attribute supports only file.',
			'drawingsFiles.*.mimes' => 'The :attribute supports only zip, svg, png, jpg or gif.',
			'tags.required' => 'Enter the :attribute.',
			'mediaContact.required' => 'Enter the :attribute.',
			'mediaKitAccess.required' => 'Enter the :attribute.',
		];
	}

	public function validationAttributes()
	{
		return [
			'projectTitle' => 'project title',
			'category' => 'category',
			'siteArea' => 'site area',
			'siteAreaUnit' => 'site area unit',
			'builtUpArea' => 'built up area',
			'builtUpAreaUnit' => 'built up area unit',
			//'location' => 'location',
			'selectedCountry' => 'country',
			'selectedState' => 'state',
			'selectedCity' => 'city',
			'status' => 'status',
			'materials' => 'materials',
			'buildingTypology' => 'building typology',
			'buildingUse' => 'building use',
			'imageCredits' => 'image credits',
			'textCredits' => 'text credits',
			'renderCredits' => 'render credits',
			'consultants' => 'consultants',
			'designTeam' => 'design team',
			'coverImage' => 'cover image',
			'projectBrief' => 'project brief',
			'projectFile' => 'project document',
			'projectLink' => 'project link',
			'photographsFiles' => 'photographs',
			'drawingsFiles' => 'drawings',
			'tags' => 'tags',
			'mediaContact' => 'media contact',
			'mediaKitAccess' => 'media kit access',
		];
	}

	public function data()
	{
		return [
			'projectTitle' => $this->projectTitle,
			'category' => $this->category,
			'siteArea' => $this->siteArea,
			'siteAreaUnit' => $this->siteAreaUnit,
			'builtUpArea' => $this->builtUpArea,
			'builtUpAreaUnit' => $this->builtUpAreaUnit,
			//'location' => $this->location,
			'selectedCountry' => $this->selectedCountry,
			'selectedState' => $this->selectedState,
			'selectedCity' => $this->selectedCity,
			'status' => $this->status,
			'materials' => $this->materials,
			'buildingTypology' => $this->buildingTypology,
			'buildingUse' => $this->buildingUse,
			'imageCredits' => $this->imageCredits,
			'textCredits' => $this->textCredits,
			'renderCredits' => $this->renderCredits,
			'consultants' => $this->consultants,
			'designTeam' => $this->designTeam,
			'coverImage' => $this->coverImage,
			'projectBrief' => $this->projectBrief,
			'projectFile' => $this->projectFile,
			'projectLink' => $this->projectLink ? 'http://' . $this->projectLink : null,
			'photographsFiles' => $this->photographsFiles,
			'drawingsFiles' => $this->drawingsFiles,
			'tags' => $this->tags,
			'mediaContact' => $this->mediaContact,
			'mediaKitAccess' => $this->mediaKitAccess,
		];
	}

	public function add()
	{
		$validated = Validator::make($this->data(), $this->rules(), $this->messages(), $this->validationAttributes())->validate();
		//dd($validated);
		if($this->addStoryService->addProject($validated)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully created project.'
			]);
			return to_route('architect.add-story.press-release.success');
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in creating project. Please try again or contact support.'
		]);
	}
}
