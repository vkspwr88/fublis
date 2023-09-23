<?php

namespace App\Models;

use App\Casts\DateCast;
use App\Casts\NameCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

	protected $guarded = [];

	protected $casts = [
		'author' => NameCast::class,
		'published_date' => DateCast::class,
	];

	public function categories(): BelongsToMany{
		return $this->belongsToMany(BlogCategory::class, 'blog_category_blogs');
	}

	public function industries(): BelongsToMany{
		return $this->belongsToMany(BlogIndustry::class, 'blog_industry_blogs');
	}

	public function tags(): BelongsToMany{
		return $this->belongsToMany(BlogTag::class, 'blog_tag_blogs');
	}
}
