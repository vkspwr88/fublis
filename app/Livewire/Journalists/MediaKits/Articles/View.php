<?php

namespace App\Livewire\Journalists\MediaKits\Articles;

use Livewire\Component;

class View extends Component
{
	public $article;

	public function mount($article)
	{
		$this->article = $article;
	}

    public function render()
    {
        return view('livewire.journalists.media-kits.articles.view');
    }
}
