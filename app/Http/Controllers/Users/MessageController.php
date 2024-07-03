<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreMessageRequest;
use App\Models\Chat;
use App\Services\ChatService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
	private ChatService $chatService;

	public function __construct(ChatService $chatService)
	{
		$this->chatService = $chatService;
	}

	public function subjects()
	{
		return $this->chatService->getUserChats();
	}

	public function chats(string $id = null)
	{
		return $this->chatService->getUserChatMessages($id);
	}

    public function send(StoreMessageRequest $request)
	{
		$validated = $request->validated();

		return $this->chatService->createChatMessage([
			'chat_id' => $validated['selectedChat'],
			'user_id' => auth()->id(),
			'message' => $validated['newMessage'],
		]);
	}

	public static function getTotalUnread()
	{
		return Chat::where([
			'sender_id' => auth()->id(),
			'sender_unread' => true,
		])->count() + Chat::where([
			'receiver_id' => auth()->id(),
			'receiver_unread' => true,
		])->count();
	}

	public static function markAsRead()
	{
		Chat::where([
			'sender_id' => auth()->id(),
			'sender_unread' => true,
		])->update([
			'sender_unread' => false,
		]);

		Chat::where([
			'receiver_id' => auth()->id(),
			'receiver_unread' => true,
		])->update([
			'receiver_unread' => false,
		]);
	}
}
