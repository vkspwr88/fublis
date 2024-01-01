<?php

namespace App\Models;

use App\Casts\EmailCast;
use App\Casts\NameCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class InviteColleague extends Model
{
    use HasFactory, HasUuids;

	protected $casts = [
		'name' => NameCast::class,
		'email' => EmailCast::class,
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class, 'invited_by');
	}

	public function notification(): MorphOne
	{
		return $this->morphOne(Notification::class, 'notifiable');
	}
}
