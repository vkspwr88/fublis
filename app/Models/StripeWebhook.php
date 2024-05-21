<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripeWebhook extends Model
{
    use HasFactory;

	protected $guarded = [];

	/**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'webhook_request' => 'array',
    ];
}
