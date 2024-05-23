<?php

namespace App\Models;

use App\Mail\Admin\PaidUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Mail;
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

	public static function boot() {
        parent::boot();

        static::created(function($item) {
			if($item->stripe_status == 'active'){
				Mail::to(env('COMPANY_EMAIL'))
					->cc(['amansaini87@rediffmail.com', 'Vikas@re-thinkingthefuture.com'])
					->queue(new PaidUser($item->user));
			}
        });

		static::updated(function($item) {
			if($item->stripe_status == 'active'){
				Mail::to(env('COMPANY_EMAIL'))
					->cc(['amansaini87@rediffmail.com', 'Vikas@re-thinkingthefuture.com'])
					->queue(new PaidUser($item->user));
			}
        });
    }
}
