<?php

namespace App\Livewire\Forms\Architects;

use App\Http\Controllers\Users\Architects\MediaKitController;
use App\Http\Controllers\Users\Architects\MediaKitDraftController;
use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\CompanyController;
use App\Http\Controllers\Users\ImageController;
use App\Http\Controllers\Users\ProjectAccessController;
use App\Services\AddStoryService;
use Illuminate\Support\Arr;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\Form;

class PressReleaseForm extends Form
{
	// #[Validate('image')]
	public $coverImage;
	public $pressReleaseTitle;
	public $imageCredits;
	public $category;
	public $conceptNote;
	public int $conceptNoteLength;
	public $pressReleaseWrite;
	// #[Rule('nullable|file|mimes:pdf,doc,docs,docx')]
	public $pressReleaseFile;
	public $pressReleaseLink;
	public $oldPhotographsFiles = [];
	public $photographsFiles = [];
	public $collectionName;
	public $photographsLink;
	public $tags = [];
	public $categories;
	public $mediaContacts;
	public $projectAccess;
	public $mediaContact;
	public $mediaKitAccess;
	public $croppedImage;
	public $mediaKitDraftId;

	public function mount()
	{
		// $this->characterCount();
		$this->categories = CategoryController::getAll();
		$this->mediaContacts = CompanyController::getMediaContacts();
		$this->projectAccess = ProjectAccessController::getAll();
		// $this->collectionName = 'photographsFiles';
        // $this->photographsFiles = $this->collection;
	}

	public function characterCount()
	{
		$this->conceptNoteLength = 550 - str()->length($this->conceptNote);
	}

	public function rules()
	{
		return [
			'coverImage' => $this->getValidationRule('coverImage'),
			'pressReleaseTitle' => 'required',
			'imageCredits' => 'nullable',
			'category' => 'required',
			'conceptNote' => 'required|' . __('validations/rules.mediaKitBriefCharacters'),
			'pressReleaseWrite' => 'required',
			'pressReleaseFile' => $this->getValidationRule('pressReleaseFile'),
			'pressReleaseLink' => 'nullable|required_without:pressReleaseFile|url:https',
			'photographsFiles' => 'nullable|array',
			// 'photographsFiles.*' => $this->getValidationRule('photographsFiles.*'),
			'photographsFiles.*' => Rule::forEach(function (string|null $value, string $attribute) {
				// if($attribute == 'photographsFiles.3'){
				// 	dd($value, $attribute);
				// }
				dd($value, $attribute);
				return Str::contains($value, '.tmp') ?
							'nullable|image|' . __('validations/rules.imageMimes') . '|' . __('validations/rules.bulkFilesSize') :
							'nullable|string';
			}),
			'photographsLink' => 'nullable|url:https',
			/* 'photographsFiles.*' => 'image|mimes:svg,png,jpg,gif',
			'photographsLink' => 'nullable|required_without:photographsFiles|url:https', */
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
		if ($key == 'pressReleaseFile') {
			if($this->pressReleaseFile instanceof TemporaryUploadedFile){
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
			'coverImage.required' => 'Upload the :attribute.',
			'coverImage.image' => __('validations/messages.image'),
			// 'coverImage.image' => 'The :attribute supports only image.',
			'coverImage.mimes' => __('validations/messages.imageMimes') /* 'The :attribute supports only svg, png, jpg or gif.' */,
			'coverImage.max' => __('validations/messages.coverImage.max'),
			'coverImage.dimensions' => __('validations/messages.coverImage.dimensions'),
			'pressReleaseTitle.required' => 'Enter the :attribute.',
			'imageCredits.required' => 'Enter the :attribute.',
			'category.required' => 'Select the :attribute.',
			'conceptNote.required' => 'Enter the :attribute.',
			'pressReleaseWrite.required' => 'Enter the :attribute.',
			'pressReleaseWrite.max' => __('validations/messages.mediaKitBriefCharacters'),
			'pressReleaseFile.mimes' => __('validations/messages.wordMimes'),
			'pressReleaseLink.url' => 'Enter the valid https :attribute.',
			'pressReleaseLink.required_without' => 'Enter the :attribute or upload the file.',
			'photographsFiles.*.image' => __('validations/messages.image'),
			'photographsFiles.*.mimes' => __('validations/messages.imageMimes'),
			'photographsFiles.*.max' => __('validations/messages.bulkFilesSize'),
			'photographsLink.url' => 'Enter the valid https :attribute.',
			'photographsLink.required_without' => 'Enter the :attribute or upload the file.',
			'tags.required' => 'Enter the :attribute.',
			'mediaContact.required' => 'Select the :attribute.',
			'mediaKitAccess.required' => 'Select the :attribute.',
		];
	}

	public function validationAttributes()
	{
		return [
			'coverImage' => 'cover image',
			'pressReleaseTitle' => 'press release title',
			'imageCredits' => 'image credits',
			'category' => 'category',
			'conceptNote' => 'concept note',
			'pressReleaseWrite' => 'press release',
			'pressReleaseFile' => 'press release document',
			'pressReleaseLink' => 'press release link',
			'photographsFiles' => 'photographs',
			'photographsLink' => 'photographs links',
			'tags' => 'tags',
			'mediaContact' => 'media contact',
			'mediaKitAccess' => 'media kit access',
		];
	}

	// creating the draft of the media kit
	public function draftMediaKit()
	{
		$details = [
			'media_kit_type' => 'press-release',
			'architect_id' => auth()->user()->architect->id,
			'content' => $this->all(),
		];
		return MediaKitDraftController::create($details);
	}

	// update the draft media kit data
	public function updateDraftMediaKit($draftId)
	{
		$details = [
			'media_kit_type' => 'press-release',
			'architect_id' => auth()->user()->architect->id,
			'content' => $this->all(),
		];
		// dd($details);
		return MediaKitDraftController::update($draftId, $details);
	}

	// fetch media kit data
	public function editMediaKit($mediaKit)
	{
		$this->coverImage = $mediaKit->story->cover_image_path;
		$this->pressReleaseTitle = $mediaKit->story->title;
		$this->imageCredits = $mediaKit->story->image_credits;
		$this->category = $mediaKit->category_id;
		$this->conceptNote = $mediaKit->story->concept_note;
		$this->pressReleaseWrite = $mediaKit->story->press_release_writeup;
		$this->pressReleaseFile = $mediaKit->story->press_release_doc_path;
		$this->pressReleaseLink = $mediaKit->story->press_release_doc_link;
		$this->oldPhotographsFiles = $mediaKit->story->photographs;
		$this->photographsLink = $mediaKit->story->photographs_link;
		$this->tags = $mediaKit->story->tags->pluck('name');
		$this->mediaContact = $mediaKit->media_contact_id;
		$this->mediaKitAccess = $mediaKit->project_access_id;
		// $this->characterCount();
		// dd($this->oldPhotographsFiles);
	}

	// fetch media kit draft data
	public function fetchMediaKit($mediaKitDraft)
	{
		$content = json_decode($mediaKitDraft->content);
		$this->coverImage = $content->coverImage;
		$this->pressReleaseTitle = $content->pressReleaseTitle;
		$this->imageCredits = $content->imageCredits;
		$this->category = $content->category;
		$this->conceptNote = $content->conceptNote;
		$this->pressReleaseWrite = $content->pressReleaseWrite;
		$this->pressReleaseFile = $content->pressReleaseFile;
		$this->pressReleaseLink = $content->pressReleaseLink;
		$this->photographsFiles = $content->photographsFiles;
		$this->photographsLink = $content->photographsLink;
		$this->tags = $content->tags;
		$this->mediaContact = $content->mediaContact;
		$this->mediaKitAccess = $content->mediaKitAccess;
		// $this->characterCount();
	}

	public function updateFields()
	{
		$this->pressReleaseLink = $this->pressReleaseLink ? 'https://' . trimWebsiteUrl($this->pressReleaseLink) : null;
		$this->photographsLink = $this->photographsLink ? 'https://' . trimWebsiteUrl($this->photographsLink) : null;
	}

	// public function store($type = 'new', $draftId = null)
	// store new media kit and drafted media kit
	public function store()
	{
		// dd($this->all());
		$this->updateFields();
		$this->validate();
		$addStoryService = new AddStoryService();
		return $addStoryService->addPressRelease($this->all());
	}

	public function update($mediaKitId)
	{
		// dd($this->all());
		$this->updateFields();
		$this->validate();
		$addStoryService = new AddStoryService();
		return $addStoryService->editPressRelease($mediaKitId, $this->all());
	}

	// preview functionality
	public function preview($type, $draftId = null)
	{
		$this->updateFields();
		if($type == 'create'){
			$this->validate();
			$mediaKitDraft = $this->draftMediaKit();
			return to_route('architect.add-story.press-release.preview', ['mediaKitDraft' => $mediaKitDraft->id]);
		}
		elseif($type == 'update'){
			$this->validate();
			$mediaKitDraft = $this->updateDraftMediaKit($draftId);
			return to_route('architect.add-story.press-release.preview', ['mediaKitDraft' => $mediaKitDraft->id]);
		}
		elseif($type == 'edit'){
			if($this->update($draftId)){
				$mediaKit = MediaKitController::findById($draftId);
				return to_route('architect.media-kit.press-release.view', ['mediaKit' => $mediaKit->slug]);
			}
		}

	}

	// drafting media kit
	public function draft($type, $draftId = null)
	{
		if($type == 'create'){
			$mediaKitDraft = $this->draftMediaKit();
			return to_route('architect.add-story.press-release.draft', ['mediaKitDraft' => $mediaKitDraft->id]);
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

	public function deleteMediaKit()
	{
		return to_route('architect.add-story.press-release.index');
	}
}
