<?php

namespace App\Models;

use App\Casts\NameCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    use HasFactory, HasUuids;

	protected $casts = [
		'name' => NameCast::class,
	];

	public function pressReleases(): MorphToMany
	{
		return $this->morphedByMany(PressRelease::class, 'taggable');
	}

	public function articles(): MorphToMany
	{
		return $this->morphedByMany(Article::class, 'taggable');
	}
}
