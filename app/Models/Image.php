<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory, HasUuids;

	/**
     * All of the relationships to be touched.
     *
     * @var array
     */
	protected $touches = ['imaggable'];

	public function imaggable(): MorphTo
	{
		return $this->morphTo();
	}
}
