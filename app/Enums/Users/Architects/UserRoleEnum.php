<?php

namespace App\Enums\Users\Architects;

enum UserRoleEnum: string
{
	case ADMIN = 'admin';
	case READ_ONLY = 'read_only';
}
