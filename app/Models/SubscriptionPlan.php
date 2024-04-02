<?php

namespace App\Models;

use App\Enums\Users\Architects\SubscriptionPlanTypeEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPlan extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

	protected $guarded = [];

	protected $casts = [
		'plan_type' => SubscriptionPlanTypeEnum::class,
	];

	/* public function subscriptionPrices(): HasMany
	{
		return $this->hasMany(SubscriptionPrice::class);
	} */
}
