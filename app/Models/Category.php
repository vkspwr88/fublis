<?php

namespace App\Models;

use App\Casts\NameCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

	protected $guarded = [];

	protected $casts = [
		'name' => NameCast::class,
	];

	public function companies(): HasMany
	{
		return $this->hasMany(Company::class);
	}

	/* public function publications(): HasMany
	{
		return $this->hasMany(Publication::class);
	} */

	public function publications(): BelongsToMany
	{
		return $this->belongsToMany(
			Publication::class,
			'publication_categories',
			'category_id',
			'publication_id',
		);
	}

	public function posts(): HasMany
	{
		return $this->hasMany(Post::class);
	}

	public function mediaKits(): HasMany
	{
		return $this->hasMany(MediaKit::class);
	}
}
