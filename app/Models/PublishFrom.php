<?php

namespace App\Models;

use App\Casts\NameCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublishFrom extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

	protected $casts = [
		'name' => NameCast::class,
	];

	public function publications(): BelongsToMany
	{
		return $this->belongsToMany(
			Publication::class,
			'publication_publish_froms',
			'publish_from_id',
			'publication_id',
		);
	}

	public function calls(): HasMany
	{
		return $this->hasMany(Call::class);
	}
}
