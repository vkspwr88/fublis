<?php

namespace App\View\Components\Users\MediaKits;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArchitectCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
		public $mediaKit,
	)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.users.media-kits.architect-card');
    }
}
