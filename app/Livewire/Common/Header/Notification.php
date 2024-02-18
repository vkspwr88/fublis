<?php

namespace App\Livewire\Common\Header;

use App\Http\Controllers\Users\NotificationController;
use Livewire\Attributes\On;
use Livewire\Component;

class Notification extends Component
{
	public int $totalUnread = 0;
	public $url;

	public function mount($url)
	{
		$this->url = $url;
	}

    public function render()
    {
		$this->totalUnread = NotificationController::getTotalUnread();
        return view('livewire.common.header.notification');
    }

	#[On('notification-refresh')]
	public function refresh()
	{
		$this->render();
	}
}
