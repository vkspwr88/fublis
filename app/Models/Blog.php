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
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use RalphJSmit\Laravel\SEO\Models\SEO;
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

	public function filterredCategories($categoriesId): BelongsToMany{
		return $this->categories()
					->whereIn('blog_category_id', $categoriesId);
		/* return $this->belongsToMany(BlogCategory::class)
					->using(BlogCategoryBlog::class)
					->wherePivotIn('blog_category_id', $categoriesId); */
		/* return $this->belongsToMany(BlogCategory::class)
					->using(BlogCategoryBlog::class)
					->whereIn('blog_category_id', $categoriesId); */
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

	public function seoImage(): BelongsTo{
		return $this->belongsTo(Media::class, 'seo_image_id');
	}

	public function blogSeo(): MorphOne{
		return $this->morphOne(SEO::class, 'model');
	}
}
