<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class MediaKitView extends Model
{
    use HasFactory, HasUuids;

	public function stats(): MorphOne
	{
		return $this->morphOne(Analytic::class, 'data');
	}
}
