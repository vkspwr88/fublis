<?php

namespace App\Models;

use App\Casts\NameCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectAccess extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

	protected $casts = [
		'name' => NameCast::class,
	];

	public function mediaKits(): HasMany
	{
		return $this->hasMany(MediaKit::class);
	}
}
