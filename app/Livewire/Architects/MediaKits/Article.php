<?php

namespace App\Livewire\Architects\MediaKits;

use Livewire\Component;

class Article extends Component
{
	public $article;

	public function mount($article)
	{
		$this->article = $article;
	}

    public function render()
    {
        return view('livewire.architects.media-kits.article');
    }
}
