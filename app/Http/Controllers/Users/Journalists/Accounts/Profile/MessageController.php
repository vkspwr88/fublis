<?php

namespace App\Http\Controllers\Users\Journalists\Accounts\Profile;

use App\Http\Controllers\Controller;
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
		$subjects = $this->chatService->getUserChats();
		$chatId = $subjects->count() ? $subjects[0]->id : '';
		return view('users.pages.journalists.accounts.profile.message', [
			'selectedChat' => $chatId,
			'subjectsRoute' => route('journalist.account.profile.message.subject'),
			'chatsRoute' => route('journalist.account.profile.message.chat'),
			'sendMessageRoute' => route('journalist.account.profile.message.send'),
		]);
	}
}
