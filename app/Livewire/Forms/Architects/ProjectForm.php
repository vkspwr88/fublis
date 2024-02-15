<?php

namespace App\Livewire\Forms\Architects;

use App\Http\Controllers\Users\Architects\MediaKitController;
use App\Http\Controllers\Users\Architects\MediaKitDraftController;
use App\Http\Controllers\Users\AreaController;
use App\Http\Controllers\Users\BuildingTypologyController;
use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\CompanyController;
use App\Http\Controllers\Users\ImageController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\ProjectAccessController;
use App\Http\Controllers\Users\ProjectStatusController;
use App\Services\AddStoryService;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ProjectForm extends Form
{
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
	// #[Rule('required|image|mimes:svg,png,jpg,gif|max:3100|dimensions:max_width=800,max_height=400')]
	public $coverImage;
	public $projectBrief;
	public int $projectBriefLength;
	// #[Rule('nullable|file|mimes:pdf,doc,docs,docx')]
	public $projectFile;
	public $projectLink;
	public $photographsFiles = [];
	public $oldPhotographsFiles = [];
	public $photographsLink;
	public $drawingsFiles = [];
	public $oldDrawingsFiles = [];
	public $drawingsLink;
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

	public function mount()
	{
		$this->selectedCountry = 101;
		$this->selectedState = 0;

		$this->categories = CategoryController::getAll();
		$this->areas = AreaController::getAll();
		$this->countries = LocationController::getCountries();
		$this->statuses = ProjectStatusController::getAll();
		$this->buildingTypologies = BuildingTypologyController::getAll();
		$this->mediaContacts = CompanyController::getMediaContacts();
		$this->projectAccess = ProjectAccessController::getAll();
	}

	public function characterCount()
	{
		$this->projectBriefLength = 550 - str()->length($this->projectBrief);
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
			'imageCredits' => 'nullable',
			'textCredits' => 'nullable',
			'renderCredits' => 'nullable',
			'consultants' => 'nullable',
			'designTeam' => 'nullable',
			'coverImage' => $this->getValidationRule('coverImage'),
			'projectBrief' => 'required|' . __('validations/rules.mediaKitBriefCharacters'),
			'projectFile' => $this->getValidationRule('projectFile'),
			'projectLink' => 'nullable|required_without:projectFile|url',
			'photographsFiles' => 'nullable|array',
			'photographsFiles.*' => Rule::forEach(function (string|null $value, string $attribute) {
				return Str::contains($value, '.tmp') ?
							'nullable|image|' . __('validations/rules.zipPlusImageMimes') . '|' . __('validations/rules.bulkFilesSize') :
							'nullable|string';
			}),
			// 'photographsFiles.*' => 'nullable|file|' . __('validations/rules.zipPlusImageMimes') . '|' . __('validations/rules.bulkFilesSize'),
			'photographsLink' => 'nullable|url',
			'drawingsFiles' => 'nullable|array',
			'drawingsFiles.*' => Rule::forEach(function (string|null $value, string $attribute) {
				return Str::contains($value, '.tmp') ?
							'nullable|image|' . __('validations/rules.zipPlusImageMimes') . '|' . __('validations/rules.bulkFilesSize') :
							'nullable|string';
			}),
			// 'drawingsFiles.*' => 'nullable|file|' . __('validations/rules.zipPlusImageMimes') . '|' . __('validations/rules.bulkFilesSize'),
			'drawingsLink' => 'nullable|url',
			/* 'photographsFiles' => 'required|array',
			'photographsFiles.*' => 'file|mimes:zip,svg,png,jpg,gif', */
			//'photographsFiles.*' => 'image|mimes:svg,png,jpg,gif',
			/* 'drawingsFiles' => 'required|array',
			'drawingsFiles.*' => 'file|mimes:zip,svg,png,jpg,gif', */
			//'drawingsFiles.*' => 'image|mimes:svg,png,jpg,gif',
			'tags' => 'nullable|array',
			'mediaContact' => 'required',
			'mediaKitAccess' => 'required',
		];
	}

	public function getValidationRule(String $key): string
    {
		if ($key == 'coverImage') {
			if($this->coverImage instanceof TemporaryUploadedFile){
				return __('validations/rules.coverImage') . '|' . __('validations/rules.imageMimes');
			}
			else{
				return 'required|string';
			}
		}
		if ($key == 'projectFile') {
			if($this->projectFile instanceof TemporaryUploadedFile){
				return 'nullable|file|' . __('validations/rules.wordMimes');
			}
			else{
				return 'nullable|string';
			}
		}
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
			'coverImage.image' => __('validations/messages.image'),
			'coverImage.mimes' => __('validations/messages.imageMimes'),
			'coverImage.max' => __('validations/messages.coverImage.max'),
			'coverImage.dimensions' => __('validations/messages.coverImage.dimensions'),
			'projectBrief.required' => 'Enter the :attribute.',
			'projectBrief.max' => __('validations/messages.mediaKitBriefCharacters'),
			'projectFile.mimes' => 'The :attribute supports only pdf, doc, docs or docx.',
			'projectLink.required_without' => 'Enter the :attribute or upload the file.',
			'photographsFiles.required' => 'Upload the :attribute.',
			'photographsFiles.*.file' => 'The :attribute supports only file.',
			'photographsFiles.*.mimes' => __('validations/messages.zipPlusImageMimes'),
			'photographsFiles.*.max' => __('validations/messages.bulkFilesSize'),
			'drawingsFiles.required' => 'Upload the :attribute.',
			'drawingsFiles.*.file' => 'The :attribute supports only file.',
			'drawingsFiles.*.mimes' => __('validations/messages.zipPlusImageMimes'),
			'drawingsFiles.*.max' => __('validations/messages.bulkFilesSize'),
			'tags.required' => 'Enter the :attribute.',
			'mediaContact.required' => 'Select the :attribute.',
			'mediaKitAccess.required' => 'Select the :attribute.',
			'*.url' => 'Enter the valid :attribute.',
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
			'photographsLink' => 'photographs link',
			'drawingsFiles' => 'drawings',
			'drawingsLink' => 'drawings link',
			'tags' => 'tags',
			'mediaContact' => 'media contact',
			'mediaKitAccess' => 'media kit access',
		];
	}

	/* public function data()
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
			'photographsLink' => $this->photographsLink,
			'drawingsFiles' => $this->drawingsFiles,
			'drawingsLink' => $this->drawingsLink,
			'tags' => $this->tags,
			'mediaContact' => $this->mediaContact,
			'mediaKitAccess' => $this->mediaKitAccess,
		];
	} */


	// creating the draft of the media kit
	public function draftMediaKit()
	{
		$details = [
			'media_kit_type' => 'project',
			'architect_id' => auth()->user()->architect->id,
			'content' => $this->all(),
		];
		return MediaKitDraftController::create($details);
	}

	// update the draft media kit data
	public function updateDraftMediaKit($draftId)
	{
		$details = [
			'media_kit_type' => 'project',
			'architect_id' => auth()->user()->architect->id,
			'content' => $this->all(),
		];
		// dd($details);
		return MediaKitDraftController::update($draftId, $details);
	}

	// fetch media kit data
	public function editMediaKit($mediaKit)
	{
		$this->projectTitle = $mediaKit->story->title;
		$this->category = $mediaKit->category_id;
		$this->siteArea = $mediaKit->story->site_area;
		$this->siteAreaUnit = $mediaKit->story->site_area_id;
		$this->builtUpArea = $mediaKit->story->built_up_area;
		$this->builtUpAreaUnit = $mediaKit->story->built_up_area_id;
		$this->materials = $mediaKit->story->title;
		$this->buildingTypology = $mediaKit->story->buildingUse->buildingTypology->id;
		$this->buildingUse = $mediaKit->story->building_use_id;
		/* $this->selectedCountry = $mediaKit->story->title;
		$this->selectedState = $mediaKit->story->title;
		$this->selectedCity = $mediaKit->story->title; */
		$this->status = $mediaKit->story->project_status_id;
		$this->imageCredits = $mediaKit->story->image_credits;
		$this->textCredits = $mediaKit->story->text_credits;
		$this->renderCredits = $mediaKit->story->render_credits;
		$this->consultants = $mediaKit->story->consultants;
		$this->designTeam = $mediaKit->story->design_team;
		$this->coverImage = $mediaKit->story->cover_image_path;
		$this->projectBrief = $mediaKit->story->project_brief;
		$this->projectFile = $mediaKit->story->project_doc_path;
		$this->projectLink = trimWebsiteUrl($mediaKit->story->project_doc_link);
		$this->photographsFiles = [];
		$this->oldPhotographsFiles = $mediaKit->story->photographs->where('image_type', 'photographs');
		$this->photographsLink = trimWebsiteUrl($mediaKit->story->photographs_link);
		$this->drawingsFiles = [];
		$this->oldDrawingsFiles = $mediaKit->story->photographs->where('image_type', 'drawings');
		$this->drawingsLink = trimWebsiteUrl($mediaKit->story->drawings_link);
		$this->tags = $mediaKit->story->tags->pluck('name');
		$this->mediaContact = $mediaKit->media_contact_id;
		$this->mediaKitAccess = $mediaKit->project_access_id;

		if($mediaKit->story->location){
			$city = LocationController::getCityByCityName($mediaKit->story->location->name);
			$this->selectedCity = $city->name;
			$this->selectedState = $city->state->id;
			$this->selectedCountry = $city->state->country->id;
		}
		// $this->characterCount();
		// dd($this->oldPhotographsFiles);
	}

	// fetch media kit draft data
	public function fetchMediaKit($mediaKitDraft)
	{
		$content = json_decode($mediaKitDraft->content);
		$this->projectTitle = $content->projectTitle;
		$this->category = $content->category;
		$this->siteArea = $content->siteArea;
		$this->siteAreaUnit = $content->siteAreaUnit;
		$this->builtUpArea = $content->builtUpArea;
		$this->builtUpAreaUnit = $content->builtUpAreaUnit;
		$this->materials = $content->materials;
		$this->buildingTypology = $content->buildingTypology;
		$this->buildingUse = $content->buildingUse;
		$this->selectedCountry = $content->selectedCountry;
		$this->selectedState = $content->selectedState;
		$this->selectedCity = $content->selectedCity;
		$this->status = $content->status;
		$this->imageCredits = $content->imageCredits;
		$this->textCredits = $content->textCredits;
		$this->renderCredits = $content->renderCredits;
		$this->consultants = $content->consultants;
		$this->designTeam = $content->designTeam;
		$this->coverImage = $content->coverImage;
		$this->projectBrief = $content->projectBrief;
		$this->projectFile = $content->projectFile;
		$this->projectLink = trimWebsiteUrl($content->projectLink);
		$this->photographsFiles = $content->photographsFiles;
		$this->photographsLink = trimWebsiteUrl($content->photographsLink);
		$this->drawingsFiles = $content->drawingsFiles;
		$this->drawingsLink = trimWebsiteUrl($content->drawingsLink);
		$this->tags = $content->tags;
		$this->mediaContact = $content->mediaContact;
		$this->mediaKitAccess = $content->mediaKitAccess;
	}

	public function updateFields()
	{
		$this->projectLink = trimWebsiteUrl($this->projectLink) ? 'http://' . $this->projectLink : null;
		$this->photographsLink = trimWebsiteUrl($this->photographsLink) ? 'http://' . $this->photographsLink : null;
		$this->drawingsLink = trimWebsiteUrl($this->drawingsLink) ? 'http://' . $this->drawingsLink : null;
	}

	// public function store($type = 'new', $draftId = null)
	// store new media kit and drafted media kit
	public function store()
	{
		$this->updateFields();
		$this->validate();
		$addStoryService = new AddStoryService();
		return $addStoryService->addProject($this->all());
	}

	public function update($mediaKitId)
	{
		$this->updateFields();
		$this->validate();
		$addStoryService = new AddStoryService();
		return $addStoryService->editProject($mediaKitId, $this->all());
	}

	// preview functionality
	public function preview($type, $draftId = null)
	{
		$this->updateFields();
		if($type == 'create'){
			$this->validate();
			$mediaKitDraft = $this->draftMediaKit();
			return to_route('architect.add-story.project.preview', ['mediaKitDraft' => $mediaKitDraft->id]);
		}
		elseif($type == 'update'){
			$this->validate();
			$mediaKitDraft = $this->updateDraftMediaKit($draftId);
			return to_route('architect.add-story.project.preview', ['mediaKitDraft' => $mediaKitDraft->id]);
		}
		elseif($type == 'edit'){
			if($this->update($draftId)){
				$mediaKit = MediaKitController::findById($draftId);
				return to_route('architect.media-kit.project.view', ['mediaKit' => $mediaKit->slug]);
			}
		}

	}

	// drafting media kit
	public function draft($type, $draftId = null)
	{
		if($type == 'create'){
			$mediaKitDraft = $this->draftMediaKit();
			return to_route('architect.add-story.project.draft', ['mediaKitDraft' => $mediaKitDraft->id]);
		}
		elseif($type == 'update'){
			$mediaKitDraft = $this->updateDraftMediaKit($draftId);
		}
	}

	// deleting sigle image file from the group
	public function deleteImage($id, $index, $type, $attr = '')
	{
		if($type == 'draft'){
			// dd($index, $this->photographsFiles);
			$path = Arr::pull($this->photographsFiles, $index);
			$this->updateDraftMediaKit($id);
			ImageController::deleteFile($path);
			return;
		}
		if($type == 'edit'){
			$mediaKit = MediaKitController::findById($id);
			$pressRelease = $mediaKit->story;
			ImageController::delete($pressRelease->photographs(), $index);
			$this->oldPhotographsFiles = $mediaKit->story->photographs;
			return;
		}
		//
	}
}
