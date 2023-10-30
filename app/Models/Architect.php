<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Architect extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

	protected $guarded = [];

	public function user(): BelongsTo{
		return $this->belongsTo(User::class);
	}

	public function company(): BelongsTo{
		return $this->belongsTo(Company::class);
	}

	public function position(): BelongsTo{
		return $this->belongsTo(ArchitectPosition::class, 'architect_position_id');
	}

	public function projects(): HasMany
	{
		return $this->hasMany(Project::class);
	}
}
