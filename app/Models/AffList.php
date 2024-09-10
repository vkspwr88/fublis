<?php

namespace App\Models;

use App\Enums\Affiliates\ReturnTypeEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AffList extends Model
{
    use HasFactory, HasUuids;

	protected $guarded = [];

	protected $casts = [
		'return_type' => ReturnTypeEnum::class,
	];

	public function affRegistration(): BelongsTo
	{
		return $this->belongsTo(AffRegistration::class);
	}

	public function affVisits(): HasMany
	{
		return $this->hasMany(AffVisit::class);
	}
}
