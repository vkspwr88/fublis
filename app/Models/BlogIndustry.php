<?php

namespace App\Models;

use App\Casts\NameCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogIndustry extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

	protected $fillable = [
		'name',
	];

	protected $casts = [
		'name' => NameCast::class,
	];
}
