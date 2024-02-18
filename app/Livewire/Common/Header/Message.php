<?php

namespace App\Livewire\Common\Header;

use App\Http\Controllers\Users\MessageController;
use Livewire\Attributes\On;
use Livewire\Component;

class Message extends Component
{
	public int $totalUnread = 0;
	public $url;

	public function mount($url)
	{
		$this->url = $url;
	}

	public function render()
    {
		$this->totalUnread = MessageController::getTotalUnread();
        return view('livewire.common.header.message');
    }

	#[On('message-refresh')]
	public function refresh()
	{
		$this->render();
	}
}
