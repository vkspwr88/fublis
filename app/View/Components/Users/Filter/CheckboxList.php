<?php

namespace App\View\Components\Users\Filter;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CheckboxList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
		public array $list,
		public string $type,
	)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.users.filter.checkbox-list');
    }
}
