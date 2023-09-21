<?php

namespace App\Enums\Users;

enum UserTypeEnum: string
{
	case ADMIN = 'admin';
	case ARCHITECT = 'architect';
	case JOURNALIST = 'journalist';
}
