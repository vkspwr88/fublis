<?php

namespace App\Livewire\Users\Blogs\Index;

use Livewire\Component;

class Post extends Component
{
	public $blog;

	public function mount($blog)
	{
		//dd($blog);
		$this->blog = $blog;
	}

    public function render()
    {
        return view('livewire.users.blogs.index.post');
    }
}
