<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory, HasUuids;

	public function category(): BelongsTo
	{
		return $this->belongsTo(Category::class);
	}

	public function journalist(): BelongsTo
	{
		return $this->belongsTo(Journalist::class);
	}

	public function publication(): BelongsTo
	{
		return $this->belongsTo(Publication::class);
	}
}
