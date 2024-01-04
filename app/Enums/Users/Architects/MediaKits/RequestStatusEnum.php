<?php

namespace App\Enums\Users\Architects\MediaKits;

enum RequestStatusEnum: string
{
	case PENDING = 'pending';
	case APPROVED = 'approved';
	case DECLINED = 'declined';
}
