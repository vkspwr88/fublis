<?php

namespace App\Enums\Users\Architects;

enum UserRoleEnum: string
{
	case SUPERADMIN = 'super_admin';
	case ADMIN = 'admin';
	case READ_ONLY = 'read_only';
}
