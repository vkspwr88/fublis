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
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ArticleForm extends Form
{
    // #[Rule('required|image|mimes:svg,png,jpg,gif|max:3100|dimensions:max_width=800,max_height=400')]
	public $coverImage;
	public $articleTitle;
	public $textCredits;
	public $category;
	public $previewText;
	public int $previewTextLength;
	// #[Rule('nullable|file|mimes:pdf,doc,docs,docx')]
	public $articleFile;
	public $articleLink;
	public $articleWrite;
	// #[Rule('nullable|file|mimes:pdf,doc,docs,docx')]
	public $companyProfileFile;
	public $companyProfileLink;
	public $oldImagesFiles = [];
	public $imagesFiles = [];
	public $imagesLink;
	public $tags = [];
	public $categories;
	public $mediaContacts;
	public $projectAccess;
	public $mediaContact;
	public $mediaKitAccess;

	public function mount()
	{
		$this->categories = CategoryController::getAll();
		$this->mediaContacts = CompanyController::getMediaContacts();
		$this->projectAccess = ProjectAccessController::getAll();
	}

	public function characterCount()
	{
		$this->previewTextLength = 550 - str()->length($this->previewText);
	}

	public function rules()
	{
		return [
			'coverImage' => $this->getValidationRule('coverImage'),
			'articleTitle' => 'required',
			'textCredits' => 'required',
			'category' => 'required',
			'previewText' => 'required|' . __('validations/rules.mediaKitBriefCharacters'),
			'articleFile' => $this->getValidationRule('articleFile'),
			'articleLink' => 'nullable|required_without:articleFile|url',
			'articleWrite' => 'nullable',
			'companyProfileFile' => $this->getValidationRule('companyProfileFile'),
			'companyProfileLink' => 'nullable|url',
			// 'companyProfileLink' => 'nullable|required_without:companyProfileFile|url',
			'imagesFiles' => 'nullable|array',
			'imagesFiles.*' => Rule::forEach(function (string|null $value, string $attribute) {
				return Str::contains($value, '.tmp') ?
							'nullable|image|' . __('validations/rules.imageMimes') . '|' . __('validations/rules.bulkFilesSize') :
							'nullable|string';
			}),
			'imagesLink' => 'nullable|url',
			/* 'imagesFiles.*' => 'image|mimes:svg,png,jpg,gif',
			'imagesLink' => 'nullable|required_without:imagesFiles|url', */
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
		if ($key == 'articleFile') {
			if($this->articleFile instanceof TemporaryUploadedFile){
				return 'nullable|file|' . __('validations/rules.wordMimes');
			}
			else{
				return 'nullable|string';
			}
		}
		if ($key == 'companyProfileFile') {
			if($this->companyProfileFile instanceof TemporaryUploadedFile){
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
			'articleTitle.required' => 'Enter the :attribute.',
			'textCredits.required' => 'Enter the :attribute.',
			'category.required' => 'Select the :attribute.',
			'previewText.required' => 'Enter the :attribute.',
			'articleFile.mimes' => 'The :attribute supports only pdf, doc, docs or docx.',
			'articleLink.url' => 'Enter the valid :attribute.',
			'articleLink.required_without' => 'Enter the :attribute or upload the file.',
			'articleWrite.required' => 'Enter the :attribute.',
			'articleWrite.max' => __('validations/messages.mediaKitBriefCharacters'),
			'companyProfileFile.mimes' => 'The :attribute supports only pdf, doc, docs or docx.',
			'companyProfileLink.url' => 'Enter the valid :attribute.',
			'companyProfileLink.required_without' => 'Enter the :attribute or upload the file.',
			'imagesFiles.*.image' => __('validations/messages.image'),
			'imagesFiles.*.mimes' => __('validations/messages.imageMimes'),
			'imagesFiles.*.max' => __('validations/messages.bulkFilesSize'),
			'imagesLink.url' => 'Enter the valid :attribute.',
			'imagesLink.required_without' => 'Enter the :attribute or upload the file.',
			'tags.required' => 'Enter the :attribute.',
			'mediaContact.required' => 'Select the :attribute.',
			'mediaKitAccess.required' => 'Select the :attribute.',
		];
	}

	public function validationAttributes()
	{
		return [
			'coverImage' => 'cover image',
			'articleTitle' => 'article title',
			'textCredits' => 'text credits',
			'category' => 'category',
			'previewText' => 'preview note',
			'articleFile' => 'article document',
			'articleLink' => 'article link',
			'articleWrite' => 'article',
			'companyProfileFile' => 'company profile document',
			'companyProfileLink' => 'company profile link',
			'imagesFiles' => 'images',
			'imagesLink' => 'images links',
			'tags' => 'tags',
			'mediaContact' => 'media contact',
			'mediaKitAccess' => 'media kit access',
		];
	}

	/* public function data()
	{
		return [
			'coverImage' => $this->coverImage,
			'articleTitle' => $this->articleTitle,
			'textCredits' => $this->textCredits,
			'category' => $this->category,
			'previewText' => $this->previewText,
			'articleFile' => $this->articleFile,
			'articleLink' => $this->articleLink ? 'http://' . $this->articleLink : null,
			'articleWrite' => $this->articleWrite,
			'companyProfileFile' => $this->companyProfileFile,
			'companyProfileLink' => $this->companyProfileLink ? 'http://' . $this->companyProfileLink : null,
			'imagesFiles' => $this->imagesFiles,
			'imagesLink' => $this->imagesLink ? 'http://' . $this->imagesLink : null,
			'tags' => $this->tags,
			'mediaContact' => $this->mediaContact,
			'mediaKitAccess' => $this->mediaKitAccess,
		];
	} */

	// creating the draft of the media kit
	public function draftMediaKit()
	{
		$details = [
			'media_kit_type' => 'article',
			'architect_id' => auth()->user()->architect->id,
			'content' => $this->all(),
		];
		return MediaKitDraftController::create($details);
	}

	// update the draft media kit data
	public function updateDraftMediaKit($draftId)
	{
		$details = [
			'media_kit_type' => 'article',
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
		$this->articleTitle = $mediaKit->story->title;
		$this->textCredits = $mediaKit->story->text_credits;
		$this->category = $mediaKit->category_id;
		$this->previewText = $mediaKit->story->preview_text;
		$this->articleFile = $mediaKit->story->article_doc_path;
		$this->articleLink = $mediaKit->story->article_doc_link;
		$this->articleWrite = $mediaKit->story->article_writeup;
		$this->companyProfileFile = $mediaKit->story->company_profile_path;
		$this->companyProfileLink = $mediaKit->story->company_profile_link;
		$this->oldImagesFiles = $mediaKit->story->images;
		$this->imagesLink = $mediaKit->story->images_link;
		$this->tags = $mediaKit->story->tags->pluck('name');
		$this->mediaContact = $mediaKit->media_contact_id;
		$this->mediaKitAccess = $mediaKit->project_access_id;
	}

	// fetch media kit draft data
	public function fetchMediaKit($mediaKitDraft)
	{
		$content = json_decode($mediaKitDraft->content);
		$this->coverImage = $content->coverImage;
		$this->articleTitle = $content->articleTitle;
		$this->textCredits = $content->textCredits;
		$this->category = $content->category;
		$this->previewText = $content->previewText;
		$this->articleWrite = $content->articleWrite;
		$this->articleFile = $content->articleFile;
		$this->articleLink = trimWebsiteUrl($content->articleLink);
		$this->companyProfileFile = $content->companyProfileFile;
		$this->companyProfileLink = trimWebsiteUrl($content->companyProfileLink);
		$this->imagesFiles = $content->imagesFiles;
		$this->imagesLink = trimWebsiteUrl($content->imagesLink);
		$this->tags = $content->tags;
		$this->mediaContact = $content->mediaContact;
		$this->mediaKitAccess = $content->mediaKitAccess;
		// $this->characterCount();
	}

	// public function store($type = 'new', $draftId = null)
	// store new media kit and drafted media kit

	public function updateFields()
	{
		$this->articleLink = $this->articleLink ? 'http://' . trimWebsiteUrl($this->articleLink) : null;
		$this->companyProfileLink = $this->companyProfileLink ? 'http://' . trimWebsiteUrl($this->companyProfileLink) : null;
		$this->imagesLink = $this->imagesLink ? 'http://' . trimWebsiteUrl($this->imagesLink) : null;
	}

	public function store()
	{
		$this->updateFields();
		$this->validate();
		$addStoryService = new AddStoryService();
		return $addStoryService->addArticle($this->all());
	}

	public function update($mediaKitId)
	{
		$this->updateFields();
		$this->validate();
		$addStoryService = new AddStoryService();
		return $addStoryService->editArticle($mediaKitId, $this->all());
	}

	// preview functionality
	public function preview($type, $draftId = null)
	{
		$this->updateFields();
		// When creating new media  kit
		if($type == 'create'){
			$this->validate();
			$mediaKitDraft = $this->draftMediaKit();
			return to_route('architect.add-story.article.preview', ['mediaKitDraft' => $mediaKitDraft->id]);
		}
		// when updating media kit draft
		elseif($type == 'update'){
			$this->validate();
			$mediaKitDraft = $this->updateDraftMediaKit($draftId);
			return to_route('architect.add-story.article.preview', ['mediaKitDraft' => $mediaKitDraft->id]);
		}
		// when updating media kit
		elseif($type == 'edit'){
			if($this->update($draftId)){
				$mediaKit = MediaKitController::findById($draftId);
				return to_route('architect.media-kit.article.view', ['mediaKit' => $mediaKit->slug]);
			}
		}
	}

	// drafting media kit
	public function draft($type, $draftId = null)
	{
		if($type == 'create'){
			$mediaKitDraft = $this->draftMediaKit();
			return to_route('architect.add-story.article.draft', ['mediaKitDraft' => $mediaKitDraft->id]);
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
			$path = Arr::pull($this->imagesFiles, $index);
			$this->updateDraftMediaKit($id);
			ImageController::deleteFile($path);
			return;
		}
		if($type == 'edit'){
			$mediaKit = MediaKitController::findById($id);
			$article = $mediaKit->story;
			ImageController::delete($article->images(), $index);
			$this->oldImagesFiles = $mediaKit->story->images;
			return;
		}
		//
	}

}
