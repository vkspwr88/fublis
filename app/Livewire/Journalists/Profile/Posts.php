<?php

namespace App\Livewire\Journalists\Profile;

use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\PostController;
use App\Http\Controllers\Users\PublicationController;
use App\Services\JournalistPostService;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Posts extends Component
{
	use WithPagination, WithoutUrlPagination;

	private JournalistPostService $postService;

	public $selectedStoryType;
	public $selectedCategory;
	public $selectedPublication;
	public $postUrl;
	public $showMeta = false;
	public string $metaTitle = '';
	public string $metaContent = '';

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
			'posts' => $this->postService->getJournalistPosts($this->journalist)->paginate(10),
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

	public function loadMeta()
	{
		$this->showMeta = false;
		Validator::make(
			["postUrl" => $this->postUrl],
			['postUrl' => 'required|url'],
			[
				'required' => 'Enter the :attribute.',
				'url' => 'Enter the valid :attribute started with https://.',
			],
			['postUrl' => 'url']
		)->validate();
		//dd($validated);
		$metaTags = get_meta_tags($this->postUrl);
		// dd($metaTags);
		if(isset($metaTags['twitter:title']) && isset($metaTags['description'])){
			$this->showMeta = true;
			$this->metaTitle = $metaTags['twitter:title'];
			$this->metaContent = $metaTags['description'];
			// return;
		}
		/* $this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'Unable to fetch meta records of the URL.'
		]); */
	}


	public function save()
	{
		//dd(get_meta_tags($this->postUrl));
		$validated = $this->validate($this->rules(), $this->messages(), $this->validationAttributes());

		/* if($this->metaTitle == '' || $this->metaContent == ''){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Unable to save post without meta records.'
			]);
			return;
		} */
		$validated['metaTitle'] = $this->metaTitle;
		$validated['metaContent'] = $this->metaContent;
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

	public function deletePost($postID)
	{
		$post = PostController::getPostById($postID);
		if(!$post){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Invalid post.'
			]);
			return;
		}
		if($post->journalist_id != auth()->user()->journalist->id){
			$this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Not authorized.'
			]);
			return;
		}
		$post->delete();
		$this->dispatch('alert', [
			'type' => 'success',
			'message' => 'Post deleted successfully.'
		]);
	}

	public function clear()
	{
		$this->selectedStoryType = '';
		$this->selectedCategory = '';
		$this->postUrl = '';
		$this->selectedPublication = '';
		$this->metaTitle = '';
		$this->metaContent = '';
		$this->showMeta = false;
	}
}
