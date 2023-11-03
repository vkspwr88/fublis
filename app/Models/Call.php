<?php

namespace App\Models;

use App\Casts\NameCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Call extends Model
{
    use HasFactory, HasUuids;

	protected $casts = [
		'title' => NameCast::class,
	];


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

	public function language(): BelongsTo
	{
		return $this->belongsTo(Language::class);
	}

	public function tags(): MorphToMany
	{
		return $this->morphToMany(Tag::class, 'taggable');
	}
}
