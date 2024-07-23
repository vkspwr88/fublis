<?php

namespace App\Models;

use App\Enums\Affiliates\ApplicationStatusEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AffRegistration extends Model
{
    use HasFactory, HasUuids;

	protected $guarded = [];

	protected $casts = [
		'application_status' => ApplicationStatusEnum::class,
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function affList(): HasOne
	{
		return $this->hasOne(AffList::class);
	}
}
