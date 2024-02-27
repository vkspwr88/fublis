<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TopPublicationList extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

	public function topPublication(): BelongsTo
	{
		return $this->belongsTo(TopPublication::class);
	}

	public function publication(): BelongsTo
	{
		return $this->belongsTo(Publication::class);
	}
}
