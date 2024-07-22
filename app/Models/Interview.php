<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Interview extends Model
{
    use HasFactory, HasUuids;

	protected $guarded = [];

	public function getRouteKey(): mixed
	{
		return $this->slug;
	}

	public function interviewQuestions(): HasMany
	{
		return $this->hasMany(InterviewQuestion::class);
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function projectBrief(): MorphMany
	{
		return $this->morphMany(Image::class, 'imaggable');
	}

	public function creator(): BelongsTo
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	public function updator(): BelongsTo
	{
		return $this->belongsTo(User::class, 'updated_by');
	}
}
