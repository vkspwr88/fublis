<?php

namespace App\Models;

use App\Enums\Users\Architects\MediaKits\RequestStatusEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class DownloadRequest extends Model
{
    use HasFactory, HasUuids;

	protected $guarded = [];

	protected $casts = [
		'request_status' => RequestStatusEnum::class,
	];

	public function mediaKit(): BelongsTo
	{
		return $this->belongsTo(MediaKit::class);
	}

	public function requestedJournalist(): BelongsTo
	{
		return $this->belongsTo(User::class, 'requested_by');
	}

	public function notification(): MorphOne
	{
		return $this->morphOne(Notification::class, 'notifiable');
	}
}
