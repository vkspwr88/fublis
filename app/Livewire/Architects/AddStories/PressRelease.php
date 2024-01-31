<?php

namespace App\Livewire\Architects\AddStories;

ini_set('max_execution_time', 300);
use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\CompanyController;
use App\Http\Controllers\Users\ProjectAccessController;
use App\Services\AddStoryService;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class PressRelease extends Component
{
	use WithFileUploads;

	#[Rule('image')]
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
	public $photographsFiles = [];
	public $photographsLink;
	public $tags = [];
	public $categories;
	public $mediaContacts;
	public $projectAccess;
	public $mediaContact;
	public $mediaKitAccess;
	public $croppedImage;

	private AddStoryService $addStoryService;

    public function render()
    {
        return view('livewire.architects.add-stories.press-release');
    }

	public function mount()
	{
		$this->characterCount();
		$this->categories = CategoryController::getAll();
		$this->mediaContacts = CompanyController::getMediaContacts();
		$this->projectAccess = ProjectAccessController::getAll();
	}

	public function boot()
	{
		$this->addStoryService = app()->make(AddStoryService::class);
	}

	public function finishUpload($name, $tmpPath, $isMultiple)
    {
		/* $this->cleanupOldUploads();
		dd($name, $tmpPath, $isMultiple);
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
        $this->syncInput($name, $file); */
		dd($name, $tmpPath, $isMultiple);

		$this->cleanupOldUploads();
        $files = collect($tmpPath)->map(function ($i) {
            return TemporaryUploadedFile::createFromLivewire($i);
        })->toArray();
        $this->emitSelf('upload:finished', $name, collect($files)->map->getFilename()->toArray());
        $files = array_merge($this->getPropertyValue($name), $files);
        $this->syncInput($name, $files);
    }

	//#[Renderless]
	public function characterCount()
	{
		$this->conceptNoteLength = 550 - str()->length($this->conceptNote);
	}

	public function rules()
	{
		return [
			'coverImage' => __('validations/rules.coverImage') . '|' . __('validations/rules.imageMimes'),
			'pressReleaseTitle' => 'required',
			'imageCredits' => 'nullable',
			'category' => 'required',
			'conceptNote' => 'required|' . __('validations/rules.mediaKitBriefCharacters'),
			'pressReleaseWrite' => 'required',
			'pressReleaseFile' => 'nullable|file|' . __('validations/rules.wordMimes'),
			'pressReleaseLink' => 'nullable|required_without:pressReleaseFile|url',
			'photographsFiles' => 'nullable|array',
			'photographsFiles.*' => 'nullable|image|' . __('validations/rules.imageMimes') . '|' . __('validations/rules.bulkFilesSize'),
			'photographsLink' => 'nullable|url',
			/* 'photographsFiles.*' => 'image|mimes:svg,png,jpg,gif',
			'photographsLink' => 'nullable|required_without:photographsFiles|url', */
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
			'pressReleaseTitle.required' => 'Enter the :attribute.',
			'imageCredits.required' => 'Enter the :attribute.',
			'category.required' => 'Select the :attribute.',
			'conceptNote.required' => 'Enter the :attribute.',
			'pressReleaseWrite.required' => 'Enter the :attribute.',
			'pressReleaseWrite.max' => __('validations/messages.mediaKitBriefCharacters'),
			'pressReleaseFile.mimes' => __('validations/messages.wordMimes'),
			'pressReleaseLink.url' => 'Enter the valid :attribute.',
			'pressReleaseLink.required_without' => 'Enter the :attribute or upload the file.',
			'photographsFiles.*.image' => __('validations/messages.image'),
			'photographsFiles.*.mimes' => __('validations/messages.imageMimes'),
			'photographsFiles.*.max' => __('validations/messages.bulkFilesSize'),
			'photographsLink.url' => 'Enter the valid :attribute.',
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

	public function data()
	{
		return [
			'coverImage' => $this->coverImage,
			'pressReleaseTitle' => $this->pressReleaseTitle,
			'imageCredits' => $this->imageCredits,
			'category' => $this->category,
			'conceptNote' => $this->conceptNote,
			'pressReleaseWrite' => $this->pressReleaseWrite,
			'pressReleaseFile' => $this->pressReleaseFile,
			'pressReleaseLink' => $this->pressReleaseLink ? 'http://' . $this->pressReleaseLink : null,
			'photographsFiles' => $this->photographsFiles,
			'photographsLink' => $this->photographsLink ? 'http://' . $this->photographsLink : null,
			'tags' => $this->tags,
			'mediaContact' => $this->mediaContact,
			'mediaKitAccess' => $this->mediaKitAccess,
		];
	}

	/* public function setContent($content)
	{
		$this->pressReleaseWrite = $content;
	} */

	public function add()
	{
		// dd($this->photographsFiles);
		//dd($this->pressReleaseWrite, $this->conceptNote);
		//dd($this->tags);
		//dd($this->pressReleaseFile, $this->pressReleaseLink, $this->photographsFiles, $this->photographsLink);
		//$validated = $this->validate();
		$validated = Validator::make($this->data(), $this->rules(), $this->messages(), $this->validationAttributes())->validate();
		//dd($validated);
		if($this->addStoryService->addPressRelease($validated)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully created press release.'
			]);
			return to_route('architect.add-story.press-release.success');
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in creating press release. Please try again or contact support.'
		]);
	}
}
