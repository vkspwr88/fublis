<?php

namespace App\Enums\Users\Architects;

enum UserRoleEnum: string
{
	case SUPERADMIN = 'super_admin';
	case ADMIN = 'admin';
	case READ_ONLY = 'read_only';

	public function label(): string
    {
        return match($this)
        {
            self::SUPERADMIN => 'Super Admin',
            self::ADMIN => 'Admin',
            self::READ_ONLY => 'Read Only',
        };
    }
}
