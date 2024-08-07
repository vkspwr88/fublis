<?php

namespace App\Models;

use App\Casts\NameCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

	protected $guarded = [];

	protected $casts = [
		'name' => NameCast::class,
	];

	public function architects(): HasMany
	{
		return $this->hasMany(Architect::class);
	}

	public function companies(): HasMany
	{
		return $this->hasMany(Company::class);
	}

	public function projects(): HasMany
	{
		return $this->hasMany(Project::class);
	}

	public function publications(): HasMany
	{
		return $this->hasMany(Publication::class);
	}

	public function journalists(): HasMany
	{
		return $this->hasMany(Journalist::class);
	}

	public function calls(): HasMany
	{
		return $this->hasMany(Call::class);
	}

	public function city(): BelongsTo
	{
		return $this->belongsTo(
			City::class,
			'name',
			'name',
		);
	}

	public function country(): BelongsTo
	{
		return $this->belongsTo(
			Country::class,
			'name',
			'name',
		);
	}
}
