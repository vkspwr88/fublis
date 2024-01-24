<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Chat extends Model
{
    use HasFactory, HasUuids;

	public function pitch(): BelongsTo {
		return $this->belongsTo(Pitch::class);
	}

	public function sender(): BelongsTo {
		return $this->belongsTo(User::class, 'sender_id');
	}

	public function receiver(): BelongsTo {
		return $this->belongsTo(User::class, 'receiver_id');
	}

	public function messages(): HasMany {
		return $this->hasMany(ChatMessage::class);
	}

	public function latestMessage(): HasOne {
		return $this->hasOne(ChatMessage::class)->latestOfMany();
	}

	public function notification(): MorphOne
	{
		return $this->morphOne(Notification::class, 'notifiable');
	}
}
