<?php

namespace App\Models;

use App\Casts\NameCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publication extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

	protected $casts = [
		'name' => NameCast::class,
	];

	public function getRouteKey(): mixed
	{
		return $this->slug;
	}

	public function journalists(): BelongsToMany
	{
		return $this->belongsToMany(
			Journalist::class,
			'journalist_publications',
			'publication_id',
			'journalist_id',
		);
	}

	/* public function position($journalistId, $publicationId)
	{
		return $this->hasOne(
			JournalistPublication::class,
			'publication_id',
		);
					->where([
						'journalist_id' => $journalistId,
						'publication_id' => $publicationId
					]);
	} */

	/* public function positions(): BelongsToMany
	{
		return $this->belongsToMany(
			Journalist::class,
			'journalist_publications',
			'publication_id',
			'journalist_position_id',
		);
	} */

	public function associatedJournalists(): BelongsToMany
	{
		return $this->belongsToMany(
			Journalist::class,
			'associated_publications',
			'publication_id',
			'journalist_id',
		);
	}

	public function categories(): BelongsToMany
	{
		return $this->belongsToMany(
			Category::class,
			'publication_categories',
			'publication_id',
			'category_id',
		);
	}

	public function location(): BelongsTo
	{
		return $this->belongsTo(Location::class);
	}

	public function publicationTypes(): BelongsToMany
	{
		return $this->belongsToMany(
			PublicationType::class,
			'publication_publication_types',
			'publication_id',
			'publication_type_id',
		);
	}

	public function languages(): BelongsToMany
	{
		return $this->belongsToMany(
			Language::class,
			'publication_languages',
			'publication_id',
			'language_id',
		);
	}

	public function publishFrom(): BelongsToMany
	{
		return $this->belongsToMany(
			PublishFrom::class,
			'publication_publish_froms',
			'publication_id',
			'publish_from_id',
		);
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

	public function language(): BelongsTo
	{
		return $this->belongsTo(Language::class);
	}

	public function posts(): HasMany
	{
		return $this->hasMany(Post::class);
	}

	public function topPublications(): BelongsToMany
	{
		return $this->belongsToMany(TopPublication::class, 'top_publication_list');
	}
}
