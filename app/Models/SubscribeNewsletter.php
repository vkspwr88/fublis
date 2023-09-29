<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscribeNewsletter extends Model
{
    use HasFactory, SoftDeletes;

	protected $fillable = [
		'email',
	];

	protected $casts = [
		'email' => EmailCast::class,
		'email_verified_at' => 'datetime',
	];
}
