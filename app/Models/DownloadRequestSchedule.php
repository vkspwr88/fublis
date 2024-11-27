<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DownloadRequestSchedule extends Model
{
    use HasFactory, HasUuids;

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function mediaKit(): BelongsTo
	{
		return $this->belongsTo(MediaKit::class);
	}
}
