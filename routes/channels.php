<?php

use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Broadcast::channel(env('CHANNEL_NAME') . '.{chatId}', function ($user, string $chatId) {
Broadcast::channel('chats.{chatId}', function ($user, string $chatId) {
	$chat = Chat::find($chatId);
    return $user->id === $chat->sender_id || $user->id === $chat->receiver_id;
});
