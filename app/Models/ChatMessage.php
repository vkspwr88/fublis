<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class ChatMessage extends Model
{
    use HasFactory, HasUuids;

	protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => formatDateTime($value),
        );
    }

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
