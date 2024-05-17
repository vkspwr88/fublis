<?php

namespace App\Enums\Users\Architects;

enum SubscriptionPlanTypeEnum: string
{
	case MONTHLY = 'monthly';
	case QUARTERLY = 'quarterly';
	case ANNUAL = 'annual';
}
