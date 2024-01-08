<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Analytic extends Model
{
    use HasFactory, HasUuids;

	public function mediaKit(): BelongsTo
	{
		return $this->belongsTo(MediaKit::class);
	}

	public function journalist(): BelongsTo
	{
		return $this->belongsTo(Journalist::class);
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class, 'journalist_id');
	}

	public function data(): MorphTo
	{
		return $this->morphTo();
	}

	public function notification(): MorphOne
	{
		return $this->morphOne(Notification::class, 'notifiable');
	}
}
