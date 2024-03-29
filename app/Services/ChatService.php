<?php

namespace App\Services;

use App\Events\SendMessage;
use App\Models\Chat;
use App\Models\ChatMessage;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ChatService
{
	public function getChatById(string $id)
	{
		return Chat::find($id);
	}

	public function getUserChats()
	{
		return Chat::with([
						'sender',
						'receiver',
						'latestMessage',
						'pitch'
					])
					->where('sender_id', auth()->id())
					->orWhere('receiver_id', auth()->id())
					->orderBy('updated_at', 'desc')
					->get()
					/* ->load([
						//'messages.user',

					]) */;
	}

	public function getUserChatMessages(string $chatId)
	{
		$chat = Chat::where('id', $chatId)
					->where(function (Builder $query) {
						$query->where('sender_id', auth()->id())
								->orWhere('receiver_id', auth()->id());
					})
					->first()
					->load([
						'messages.user.architect.profileImage',
						'messages.user.journalist.profileImage',
					]);

		$chat = $this->loadUserChat($chat);
		// $chat->is_unread = false;
		$chat->save();
		return $chat->messages;
	}

	public function loadUserChat($chat)
	{
		$chat->load([
			'messages.user.architect.profileImage',
			'messages.user.journalist.profileImage',
		]);
		return $chat;
	}

	public function loadUserChatMessages($chatMessage)
	{
		$chatMessage->load([
			'user.architect.profileImage',
			'user.journalist.profileImage',
		]);
		return $chatMessage;
	}

	public function createChat(array $details)
	{
		return Chat::create($details);
	}

	public function createChatMessage(array $details, $sentNotification = true)
	{
		$chatMessage = ChatMessage::create($details);
		$chat = $chatMessage->chat;
		$chat->updated_at = Carbon::now();
		// $chat->is_unread = true;
		$chatMessage = $this->loadUserChatMessages($chatMessage);
		broadcast(new SendMessage($chat, $chatMessage))->toOthers();
		$receiverId = $chat->receiver_id;
		if($chat->receiver_id === $chatMessage->user_id){
			$receiverId = $chat->sender_id;
			$chat->sender_unread = true;
		}
		else{
			$chat->receiver_unread = true;
		}
		$chat->save();
		if($sentNotification){
			NotificationService::sendMessageSentNotification([
				'poly' => $chatMessage,
				'sent_to_user_id' => $receiverId,
				'sent_by' => $chatMessage->user->name,
				'message' => $chatMessage->message,
			]);
		}
		return $chatMessage;
	}
}
