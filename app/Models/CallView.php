<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CallView extends Model
{
    use HasFactory, HasUuids;

	public function call(): BelongsTo
	{
		return $this->belongsTo(Call::class);
	}

	public function seenBy(): BelongsTo
	{
		return $this->belongsTo(Architect::class, 'seen_by');
	}
}
