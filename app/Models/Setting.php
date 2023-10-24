<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Setting extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

	protected $guarded = [];

	protected function settingKey(): Attribute
	{
		return Attribute::make(
			set: fn (string $value) => strtoupper(Str::snake($value)),
		);
	}
}
