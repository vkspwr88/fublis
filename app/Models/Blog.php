<?php

namespace App\Models;

use App\Casts\DateCast;
use App\Casts\ImageCast;
use App\Casts\NameCast;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use RalphJSmit\Laravel\SEO\Support\HasSEO;


class Blog extends Model
{
    use HasFactory, SoftDeletes, HasUuids, HasSEO;

	protected $guarded = [];

	protected $casts = [
		//'home_path' => ImageCast::class,
		//'banner_path' => ImageCast::class,
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

	public function homeImage(): BelongsTo{
		return $this->belongsTo(Media::class, 'home_image_id');
	}

	public function bannerImage(): BelongsTo{
		return $this->belongsTo(Media::class, 'banner_image_id');
	}
}
