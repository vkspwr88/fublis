<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public static function markAsRead()
	{
		Notification::where('user_id', auth()->id())
					->update([
						'unread' => false,
					]);
	}

	public static function getTotalUnread()
	{
		Notification::where([
			'user_id' => auth()->id(),
			'unread' => true,
		])->count();
	}
}
