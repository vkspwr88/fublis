<?php
namespace App\View\Composers;

use Illuminate\View\View;
use App\Http\Controllers\Users\MessageController;
use App\Http\Controllers\Users\NotificationController;

class TotalUnreadComposer
{
	/**
     * Create a new profile composer.
     */
    public function __construct() {}

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
		$view->with([
			'totalUnreadNotifications' => NotificationController::getTotalUnread(),
			'totalUnreadMessages' => MessageController::getTotalUnread(),
			// 'totalUnreadNotifications' => 9,
			// 'totalUnreadMessages' => 10,
		]);
	}
}
