<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TopPublication extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

	public function category(): BelongsTo
	{
		return $this->belongsTo(Category::class);
	}

	public function location(): BelongsTo
	{
		return $this->belongsTo(Location::class);
	}

	public function topPublicationList(): HasMany
	{
		return $this->hasMany(TopPublicationList::class);
	}

	public function publications(): BelongsToMany
	{
		return $this->belongsToMany(Publication::class, 'top_publication_lists');
	}

	public function orderedPublications()
	{
		return $this->belongsToMany(Publication::class, 'top_publication_lists')
					->orderByPivot('rank_order', 'asc');
	}
}
