<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MediaKitDraft extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

	public function architect(): BelongsTo
	{
		return $this->belongsTo(Architect::class);
	}
}
