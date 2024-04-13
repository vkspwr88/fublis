<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journalist extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

	public function getRouteKey(): mixed
	{
		return $this->slug;
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function language(): BelongsTo
	{
		return $this->belongsTo(Language::class);
	}

	public function location(): BelongsTo
	{
		return $this->belongsTo(Location::class);
	}

	public function journalistPublications(): HasMany
	{
		return $this->hasMany(JournalistPublication::class);
	}

	public function publications(): BelongsToMany
	{
		return $this->belongsToMany(
			Publication::class,
			'journalist_publications',
			'journalist_id',
			'publication_id'
		);
	}

	public function associatedPublications(): BelongsToMany
	{
		return $this->belongsToMany(
			Publication::class,
			'associated_publications',
			'journalist_id',
			'publication_id'
		);
	}

	public function position(): BelongsTo
	{
		return $this->belongsTo(JournalistPosition::class, 'journalist_position_id');
	}

	public function calls(): HasMany
	{
		return $this->hasMany(Call::class);
	}

	public function profileImage(): MorphOne
	{
		return $this->morphOne(Image::class, 'imaggable');
	}

	public function pitches(): MorphMany
	{
		return $this->morphMany(Pitch::class, 'pitchable');
	}

	public function posts(): HasMany
	{
		return $this->hasMany(Post::class);
	}

	public function topJournalists(): BelongsToMany
	{
		return $this->belongsToMany(TopJournalist::class, 'top_journalist_lists');
	}
}
