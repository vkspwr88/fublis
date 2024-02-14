<?php

namespace App\Models;

use App\Enums\Users\Architects\UserRoleEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Architect extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

	protected $guarded = [];

	protected $casts = [
		'user_role' => UserRoleEnum::class,
	];

	public function getRouteKey(): mixed
	{
		return $this->slug;
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function company(): BelongsTo
	{
		return $this->belongsTo(Company::class);
	}

	public function location(): BelongsTo
	{
		return $this->belongsTo(Location::class);
	}

	public function position(): BelongsTo
	{
		return $this->belongsTo(ArchitectPosition::class, 'architect_position_id');
	}

	public function projects(): HasMany
	{
		return $this->hasMany(Project::class);
	}

	public function mediaKits(): HasMany
	{
		return $this->hasMany(MediaKit::class);
	}

	public function mediaKitDrafts(): HasMany
	{
		return $this->hasMany(MediaKitDraft::class);
	}

	public function latestMediaKits(): HasOne
	{
		return $this->hasOne(MediaKit::class)->latestOfMany();
	}

	public function profileImage(): MorphOne
	{
		return $this->morphOne(Image::class, 'imaggable');
	}
}
