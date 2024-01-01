<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class ChatMessage extends Model
{
    use HasFactory, HasUuids;

	public function chat(): BelongsTo {
		return $this->belongsTo(Chat::class);
	}

	public function user(): BelongsTo {
		return $this->belongsTo(User::class);
	}

	public function notification(): MorphOne
	{
		return $this->morphOne(Notification::class, 'notifiable');
	}
}
