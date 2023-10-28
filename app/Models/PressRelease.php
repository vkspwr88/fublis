<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class PressRelease extends Model
{
    use HasFactory, HasUuids;

	public function mediakit(): MorphMany
	{
		return $this->morphMany(MediaKit::class, 'story');
	}

	public function tags(): MorphToMany
	{
		return $this->morphToMany(Tag::class, 'taggable');
	}

	public function photographs(): MorphMany
	{
		return $this->morphMany(Image::class, 'imaggable');
	}
}
