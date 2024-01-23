<?php

namespace App\Models;

use App\Casts\NameCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Call extends Model
{
    use HasFactory, HasUuids;

	protected $casts = [
		'title' => NameCast::class,
	];

	public function getRouteKey(): mixed
	{
		return $this->slug;
	}

	public function journalist(): BelongsTo
	{
		return $this->belongsTo(Journalist::class);
	}

	public function publication(): BelongsTo
	{
		return $this->belongsTo(Publication::class);
	}

	public function category(): BelongsTo
	{
		return $this->belongsTo(Category::class);
	}

	public function location(): BelongsTo
	{
		return $this->belongsTo(Location::class);
	}

	public function publishFrom(): BelongsTo
	{
		return $this->belongsTo(PublishFrom::class);
	}

	public function language(): BelongsTo
	{
		return $this->belongsTo(Language::class);
	}

	public function tags(): MorphToMany
	{
		return $this->morphToMany(Tag::class, 'taggable');
	}

	public function pitches(): MorphMany
	{
		return $this->morphMany(Pitch::class, 'pitchable');
	}

	public function mediaKits(): BelongsToMany
	{
		return $this->belongsToMany(
			MediaKit::class,
			'pitches',
			'pitchable_id',
			'media_kit_id',
			'id',
			'id',
		);
	}
}
