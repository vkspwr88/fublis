<?php

namespace App\Models;

use App\Casts\NameCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Project extends Model
{
    use HasFactory, HasUuids;

	protected $casts = [
		'title' => NameCast::class,
	];

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

	public function location(): BelongsTo
	{
		return $this->belongsTo(Location::class);
	}

	public function siteAreaUnit(): BelongsTo
	{
		return $this->belongsTo(Area::class, 'site_area_id');
	}

	public function builtUpAreaUnit(): BelongsTo
	{
		return $this->belongsTo(Area::class, 'built_up_area_id');
	}

	public function projectStatus(): BelongsTo
	{
		return $this->belongsTo(ProjectStatus::class);
	}

	public function buildingTypology(): BelongsTo
	{
		return $this->belongsTo(BuildingTypology::class);
	}

	public function mediaContact(): BelongsTo
	{
		return $this->belongsTo(Architect::class);
	}

	public function projectAccess(): BelongsTo
	{
		return $this->belongsTo(ProjectAccess::class);
	}
}
