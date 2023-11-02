<?php

namespace App\Models;

use App\Casts\NameCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

	protected $guarded = [];

	protected $casts = [
		'name' => NameCast::class,
	];

	public function category(): BelongsTo
	{
		return $this->belongsTo(Category::class);
	}

	public function location(): BelongsTo
	{
		return $this->belongsTo(Location::class);
	}

	public function teamSize(): BelongsTo
	{
		return $this->belongsTo(TeamSize::class);
	}

	public function architects(): HasMany
	{
		return $this->hasMany(Architect::class);
	}

	public function profileImage(): MorphOne
	{
		return $this->morphOne(Image::class, 'imaggable');
	}

	public function mediaKit(): HasOneThrough
	{
		return $this->hasOneThrough(
			MediaKit::class,
			Architect::class,
		);
	}

	public function mediaKits(): HasManyThrough
	{
		return $this->hasManyThrough(
			MediaKit::class,
			Architect::class,
		);
	}
}
