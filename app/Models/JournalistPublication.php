<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class JournalistPublication extends Pivot
{
    use HasFactory;

	protected $table = 'journalist_publications';

	public $timestamps = false;

	public function journalist(): BelongsTo
    {
        return $this->belongsTo(JournalistPosition::class);
    }

	public function journalistPosition(): BelongsTo
    {
        return $this->belongsTo(JournalistPosition::class);
    }

    public function publication(): BelongsTo
    {
        return $this->belongsTo(Publication::class);
    }
}
