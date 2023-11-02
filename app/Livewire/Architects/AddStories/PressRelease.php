<?php

namespace App\Livewire\Architects\AddStories;

ini_set('max_execution_time', 300);
use App\Http\Controllers\Users\CategoryController;
use App\Services\AddStoryService;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class PressRelease extends Component
{
	use WithFileUploads;

	#[Rule('required|image|mimes:svg,png,jpg,gif|max:3100|dimensions:max_width=800,max_height=400')]
	public $coverImage;
	public $pressReleaseTitle;
	public $imageCredits;
	public $category;
	public $conceptNote;
	public $pressReleaseWrite;
	#[Rule('nullable|file|mimes:pdf,doc,docs')]
	public $pressReleaseFile;
	public $pressReleaseLink;
	public $photographsFiles = [];
	public $photographsLink;
	public $tags = [];

	private AddStoryService $addStoryService;

    public function render()
    {
        return view('livewire.architects.add-stories.press-release', [
			'categories' => CategoryController::getAll(),
		]);
    }

	public function boot()
	{
		$this->addStoryService = app()->make(AddStoryService::class);
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
			'coverImage' => 'required|image|mimes:svg,png,jpg,gif|max:3100|dimensions:max_width=800,max_height=400',
			'pressReleaseTitle' => 'required',
			'imageCredits' => 'required',
			'category' => 'required',
			'conceptNote' => 'required|max:275',
			'pressReleaseWrite' => 'required',
			'pressReleaseFile' => 'nullable|file|mimes:pdf,doc,docs',
			'pressReleaseLink' => 'nullable|required_without:pressReleaseFile|url',
			'photographsFiles' => 'nullable|array',
			'photographsFiles.*' => 'image|mimes:svg,png,jpg,gif',
			'photographsLink' => 'nullable|required_without:photographsFiles|url',
			'tags' => 'required|array',
		];
	}

	public function messages()
	{
		return [
			'coverImage.required' => 'Upload the :attribute.',
			'coverImage.image' => 'The :attribute supports only image.',
			'coverImage.mimes' => 'The :attribute supports only svg, png, jpg or gif.',
			'coverImage.max' => 'Maximum allowed size to upload :attribute 3MB.',
			'coverImage.dimensions' => 'Maximum allowed dimension for the :attribute is 800x400px.',
			'pressReleaseTitle.required' => 'Enter the :attribute.',
			'imageCredits.required' => 'Enter the :attribute.',
			'category.required' => 'Select the :attribute.',
			'conceptNote.required' => 'Enter the :attribute.',
			'pressReleaseWrite.required' => 'Enter the :attribute.',
			'pressReleaseWrite.max' => 'The :attribute allows only 275 characters.',
			'pressReleaseFile.mimes' => 'The :attribute supports only odf, doc or docs.',
			'pressReleaseLink.url' => 'Enter the valid :attribute.',
			'pressReleaseLink.required_without' => 'Enter the :attribute or upload the file.',
			'photographsFiles.*.image' => 'The :attribute supports only image.',
			'photographsFiles.*.mimes' => 'The :attribute supports only svg, png, jpg or gif.',
			'photographsLink.url' => 'Enter the valid :attribute.',
			'photographsLink.required_without' => 'Enter the :attribute or upload the file.',
			'tags.required' => 'Enter the :attribute.',
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
		];
	}

	public function add()
	{
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