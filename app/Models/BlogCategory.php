<?php

namespace App\Models;

use App\Casts\NameCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategory extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

	protected $fillable = [
		'name',
	];

	protected $casts = [
		'name' => NameCast::class,
	];

	public function blogs(): BelongsToMany{
		return $this->belongsToMany(Blog::class);
	}
}
