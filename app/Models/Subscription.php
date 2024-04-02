<?php

namespace App\Models;

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
}
