<?php

namespace App\Enums\Affiliates;

enum ApplicationStatusEnum: string
{
	case PENDING = 'pending';
	case APPROVED = 'approved';
	case DECLINED = 'declined';

	public function label(): string
    {
        return match($this)
        {
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
            self::DECLINED => 'Declined',
        };
    }
}
