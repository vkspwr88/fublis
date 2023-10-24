<?php

namespace App\Models;

use App\Casts\EmailCast;
use App\Casts\NameCast;
use App\Casts\Users\UserTypeCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Guest extends Model
{
    use HasFactory, HasUuids;

	protected $fillable = [
		'name',
		'email',
		'password',
		'user_type',
	];

	protected $hidden = [
		'password',
	];

	protected $casts = [
		'name' => NameCast::class,
		'email' => EmailCast::class,
		'email_verified_at' => 'datetime',
		'password' => 'hashed',
		'user_type' => UserTypeCast::class,
	];

	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = Hash::make($value);
	}
}
