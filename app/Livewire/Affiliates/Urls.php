<?php

namespace App\Livewire\Affiliates;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Urls extends Component
{
	public $affiliate_url;
	#[Validate('required|string')]
	public $campaign_name;
	public $campaign_url;

	public function mount()
	{
		$this->affiliate_url = config('app.url') . '?ref=' . auth()->user()->journalist->slug;
		$this->campaign_name = '';
	}

    public function render()
    {
		$this->campaign_url = $this->campaign_name != '' ? ($this->affiliate_url . '&campaign=' . $this->campaign_name) : '';
        return view('livewire.affiliates.urls');
    }
}
