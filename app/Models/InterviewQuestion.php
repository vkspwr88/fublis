<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InterviewQuestion extends Model
{
    use HasFactory, HasUuids;

	protected $guarded = [];

	public function interview(): BelongsTo
	{
		return $this->belongsTo(Interview::class);
	}
}
