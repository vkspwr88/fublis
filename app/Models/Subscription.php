<?php

namespace App\Models;

use App\Http\Controllers\Payments\StripeController;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Cashier\Subscription as CashierSubscription;

class Subscription extends CashierSubscription
{
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function subscriptionPrice(): BelongsTo
	{
		return $this->belongsTo(SubscriptionPlan::class, 'stripe_price', 'price_id');
	}

	/* public static function boot() {
        parent::boot();

        static::created(function($item) {
			StripeController::notifyAdmin($item);
        });

		static::updated(function($item) {
			StripeController::notifyAdmin($item);
        });
    } */
}
