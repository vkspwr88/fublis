<?php

namespace App\Listeners;

use App\Events\SendMessage;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMessageNotification implements ShouldQueue
{
	use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendMessage $event): void
    {
        //
		//dd($event);
		$receiverId = $event->chat->receiver_id;
		if($event->chat->receiver_id === $event->chatMessage->user_id){
			$receiverId = $event->chat->sender_id;
		}
		NotificationService::sendMessageSentNotification([
			'poly' => $event->chatMessage,
			'sent_to_user_id' => $receiverId,
			'sent_by' => $event->chatMessage->user->name,
			'message' => $event->chatMessage->message,
		]);
    }
}
