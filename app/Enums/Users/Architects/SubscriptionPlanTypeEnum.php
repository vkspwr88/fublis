<?php

namespace App\Enums\Users\Architects;

enum SubscriptionPlanTypeEnum: string
{
	case MONTHLY = 'monthly';
	case QUATERLY = 'quaterly';
	case ANNUAL = 'annual';
}