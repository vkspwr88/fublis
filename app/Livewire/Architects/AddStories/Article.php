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
	#[Rule('nullable|file|mimes:pdf,doc,docs')]
	public $articleFile;
	public $articleLink;
	public $articleWrite;
	#[Rule('nullable|file|mimes:pdf,doc,docs')]
	public $companyProfileFile;
	public $companyProfileLink;
	public $imagesFiles = [];
	public $imagesLink;
	public $tags = [];

	private AddStoryService $addStoryService;

	public function mount()
	{
		$this->characterCount();
	}

	public function render()
    {
        return view('livewire.architects.add-stories.article', [
			'categories' => CategoryController::getAll(),
		]);
    }

	public function boot()
	{
		$this->addStoryService = app()->make(AddStoryService::class);
	}

	public function characterCount()
	{
		$this->previewTextLength = 275 - str()->length($this->previewText);
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
			'articleTitle' => 'required',
			'textCredits' => 'required',
			'category' => 'required',
			'previewText' => 'required|max:275',
			'articleFile' => 'nullable|file|mimes:pdf,doc,docs',
			'articleLink' => 'nullable|required_without:articleFile|url',
			'articleWrite' => 'required',
			'companyProfileFile' => 'nullable|file|mimes:pdf,doc,docs',
			'companyProfileLink' => 'nullable|required_without:companyProfileFile|url',
			'imagesFiles' => 'nullable|array',
			'imagesFiles.*' => 'image|mimes:svg,png,jpg,gif',
			'imagesLink' => 'nullable|required_without:imagesFiles|url',
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
			'articleTitle.required' => 'Enter the :attribute.',
			'textCredits.required' => 'Enter the :attribute.',
			'category.required' => 'Select the :attribute.',
			'previewText.required' => 'Enter the :attribute.',
			'articleFile.mimes' => 'The :attribute supports only pdf, doc or docs.',
			'articleLink.url' => 'Enter the valid :attribute.',
			'articleLink.required_without' => 'Enter the :attribute or upload the file.',
			'articleWrite.required' => 'Enter the :attribute.',
			'articleWrite.max' => 'The :attribute allows only 275 characters.',
			'companyProfileFile.mimes' => 'The :attribute supports only pdf, doc or docs.',
			'companyProfileLink.url' => 'Enter the valid :attribute.',
			'companyProfileLink.required_without' => 'Enter the :attribute or upload the file.',
			'imagesFiles.*.image' => 'The :attribute supports only image.',
			'imagesFiles.*.mimes' => 'The :attribute supports only svg, png, jpg or gif.',
			'imagesLink.url' => 'Enter the valid :attribute.',
			'imagesLink.required_without' => 'Enter the :attribute or upload the file.',
			'tags.required' => 'Enter the :attribute.',
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
