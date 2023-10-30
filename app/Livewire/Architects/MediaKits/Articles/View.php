<?php

namespace App\Livewire\Architects\MediaKits\Articles;

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
        return view('livewire.architects.media-kits.articles.view');
    }
}
