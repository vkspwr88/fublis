<?php

namespace App\View\Components\Users\Journalists;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FullList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $journalists,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.users.journalists.full-list');
    }
}
