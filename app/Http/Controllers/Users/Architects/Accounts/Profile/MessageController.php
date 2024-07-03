<?php

namespace App\Http\Controllers\Users\Architects\Accounts\Profile;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\MessageController as UsersMessageController;
use App\Services\ChatService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
	private ChatService $chatService;

	public function __construct(ChatService $chatService)
	{
		$this->chatService = $chatService;
	}

    public function index(Request $request)
	{
		UsersMessageController::markAsRead();
		$subjects = $this->chatService->getUserChats();
		$chatId = $subjects->count() ? $subjects[0]->id : '';
		return view('users.pages.architects.accounts.profile.message', [
			'selectedChat' => $chatId,
			'subjectsRoute' => route('architect.account.profile.message.subject'),
			//'chatsRoute' => route('architect.account.profile.message.chat', ['id' => $chatId]),
			'chatsRoute' => route('architect.account.profile.message.chat'),
			'sendMessageRoute' => route('architect.account.profile.message.send'),
		]);
	}
}
