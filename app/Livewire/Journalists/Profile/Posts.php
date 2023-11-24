<?php

namespace App\Livewire\Journalists\Profile;

use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\PublicationController;
use App\Services\JournalistPostService;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
	use WithPagination;

	private JournalistPostService $postService;

	public $selectedStoryType;
	public $selectedCategory;
	public $selectedPublication;
	public $postUrl;

	//public $posts;
	public $journalist;
	public $categories;
	public $publications;

	public function mount($journalist)
	{
		$this->journalist = $journalist;
		$this->categories = CategoryController::getAll();
		$this->publications = PublicationController::getAllPublications($journalist);
	}

	public function boot()
	{
		$this->postService = app()->make(JournalistPostService::class);
	}

    public function render()
    {
        return view('livewire.journalists.profile.posts', [
			'posts' => $this->postService->getJournalistPosts($this->journalist)->paginate(5),
		]);
    }

	public function rules()
	{
		return [
			'selectedStoryType' => 'required',
			'selectedCategory' => 'required|exists:categories,id',
			'selectedPublication' => 'required|exists:publications,id',
			'postUrl' => 'required|url',
		];
	}

	public function messages()
	{
		return [
			'postUrl.required' => 'Enter the :attribute.',
			'postUrl.url' => 'Enter the valid :attribute started with https://.',
			'*.required' => 'Select the :attribute.',
			'*.exists' => 'Select the valid :attribute.',
		];
	}

	public function validationAttributes()
	{
		return [
			'selectedStoryType' => 'story type',
			'selectedCategory' => 'category',
			'selectedPublication' => 'publication',
			'postUrl' => 'url',
		];
	}

	public function save()
	{
		$validated = $this->validate($this->rules(), $this->messages(), $this->validationAttributes());
		//dd($validated);
		if($this->postService->createPost($validated)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully created the post.'
			]);
			$this->clear();
			$this->render();
			return;
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in creating post. Please try again or contact support.'
		]);
	}

	public function clear()
	{
		$this->selectedStoryType = '';
		$this->selectedCategory = '';
		$this->postUrl = '';
		$this->selectedPublication = '';
	}
}
