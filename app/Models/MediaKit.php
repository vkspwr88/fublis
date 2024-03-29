<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class MediaKit extends Model
{
    use HasFactory, HasUuids;

	public function getRouteKey(): mixed
	{
		return $this->slug;
	}

	public function story(): MorphTo
	{
		return $this->morphTo();
	}

	public function architect(): BelongsTo
	{
		return $this->belongsTo(Architect::class);
	}

	public function category(): BelongsTo
	{
		return $this->belongsTo(Category::class);
	}

	public function pitch(): HasMany
	{
		return $this->hasMany(Pitch::class);
	}

	public function analytics(): HasMany
	{
		return $this->hasMany(Analytic::class);
	}

	public function downloadRequests(): HasMany
	{
		return $this->hasMany(DownloadRequest::class);
	}

	public function mediaContact(): BelongsTo
	{
		return $this->belongsTo(Architect::class, 'media_contact_id');
	}

	public function projectAccess(): BelongsTo
	{
		return $this->belongsTo(ProjectAccess::class);
	}
}
