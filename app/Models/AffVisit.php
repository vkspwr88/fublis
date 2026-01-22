<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AffVisit extends Model
{
    use HasFactory, HasUuids;

	protected $guarded = [];

	public function affReferral(): HasOne
	{
		return $this->hasOne(AffReferral::class);
	}

	public function affList(): BelongsTo
	{
		return $this->belongsTo(AffList::class);
	}
}
