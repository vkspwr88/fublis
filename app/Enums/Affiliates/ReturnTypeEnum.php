<?php

namespace App\Enums\Affiliates;

enum ReturnTypeEnum: string
{
	case FIXED = 'fixed';
	case PERCENTAGE = 'percentage';

	public function label(): string
    {
        return match($this)
        {
            self::FIXED => 'Fixed',
            self::PERCENTAGE => 'Percentage',
        };
    }
}
