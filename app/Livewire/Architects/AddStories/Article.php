<?php

namespace App\Livewire\Architects\AddStories;

ini_set('max_execution_time', 300);
use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\CompanyController;
use App\Http\Controllers\Users\ProjectAccessController;
use App\Services\AddStoryService;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Article extends Component
{
    use WithFileUploads;

	#[Rule('required|image|mimes:svg,png,jpg,gif|max:3100|dimensions:max_width=800,max_height=400')]
	public $coverImage;
	public $articleTitle;
	public $textCredits;
	public $category;
	public $previewText;
	public int $previewTextLength;
	#[Rule('nullable|file|mimes:pdf,doc,docs,docx')]
	public $articleFile;
	public $articleLink;
	public $articleWrite;
	#[Rule('nullable|file|mimes:pdf,doc,docs,docx')]
	public $companyProfileFile;
	public $companyProfileLink;
	public $imagesFiles = [];
	public $imagesLink;
	public $tags = [];
	public $categories;
	public $mediaContacts;
	public $projectAccess;
	public $mediaContact;
	public $mediaKitAccess;

	private AddStoryService $addStoryService;

	public function mount()
	{
		$this->characterCount();
		$this->categories = CategoryController::getAll();
		$this->mediaContacts = CompanyController::getMediaContacts();
		$this->projectAccess = ProjectAccessController::getAll();
	}

	public function render()
    {
        return view('livewire.architects.add-stories.article');
    }

	public function boot()
	{
		$this->addStoryService = app()->make(AddStoryService::class);
	}

	public function characterCount()
	{
		$this->previewTextLength = 550 - str()->length($this->previewText);
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
			'coverImage' => __('validations/rules.coverImage') . '|' . __('validations/rules.imageMimes'),
			'articleTitle' => 'required',
			'textCredits' => 'required',
			'category' => 'required',
			'previewText' => 'required|' . __('validations/rules.mediaKitBriefCharacters'),
			'articleFile' => 'nullable|file|' . __('validations/rules.wordMimes'),
			'articleLink' => 'nullable|required_without:articleFile|url',
			'articleWrite' => 'nullable',
			'companyProfileFile' => 'nullable|file|' . __('validations/rules.wordMimes'),
			'companyProfileLink' => 'nullable|url',
			// 'companyProfileLink' => 'nullable|required_without:companyProfileFile|url',
			'imagesFiles' => 'nullable|array',
			'imagesFiles.*' => 'nullable|image|' . __('validations/rules.imageMimes') . '|' . __('validations/rules.bulkFilesSize'),
			'imagesLink' => 'nullable|url',
			/* 'imagesFiles.*' => 'image|mimes:svg,png,jpg,gif',
			'imagesLink' => 'nullable|required_without:imagesFiles|url', */
			'tags' => 'nullable|array',
			'mediaContact' => 'required',
			'mediaKitAccess' => 'required',
		];
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

	public function data()
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
	}

	public function add()
	{
		//dd($this->tags);
		$validated = Validator::make($this->data(), $this->rules(), $this->messages(), $this->validationAttributes())->validate();
		//dd($validated);
		if($this->addStoryService->addarticle($validated)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully created article.'
			]);
			return to_route('architect.add-story.article.success');
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in creating article. Please try again or contact support.'
		]);
	}
}
