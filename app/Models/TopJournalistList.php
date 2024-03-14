<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TopJournalistList extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

	protected $guarded = [];

	public function topJournalist(): BelongsTo
	{
		return $this->belongsTo(TopJournalist::class);
	}

	public function journalist(): BelongsTo
	{
		return $this->belongsTo(Journalist::class);
	}
}
