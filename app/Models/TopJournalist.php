<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TopJournalist extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

	protected $guarded = [];

	public function category(): BelongsTo
	{
		return $this->belongsTo(Category::class);
	}

	public function location(): BelongsTo
	{
		return $this->belongsTo(Location::class);
	}

	public function topJournalistList(): HasMany
	{
		return $this->hasMany(TopJournalistList::class);
	}

	public function journalists(): BelongsToMany
	{
		return $this->belongsToMany(Journalist::class, 'top_journalist_lists');
	}

	public function orderedJournalists()
	{
		return $this->belongsToMany(Journalist::class, 'top_journalist_lists')
					->orderByPivot('rank_order', 'asc');
	}
}
