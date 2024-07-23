<?php

namespace App\Enums\Users\Architects;

enum SubscriptionPlanTypeEnum: string
{
	case MONTHLY = 'monthly';
	case QUARTERLY = 'quarterly';
	case ANNUAL = 'annual';

	public function label(): string
    {
        return match($this)
        {
            self::MONTHLY => 'Monthly',
            self::QUARTERLY => 'Quarterly',
            self::ANNUAL => 'Annual',
        };
    }
}
