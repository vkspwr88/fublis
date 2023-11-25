<?php

namespace App\Models;

use App\Casts\EmailCast;
use App\Casts\NameCast;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
