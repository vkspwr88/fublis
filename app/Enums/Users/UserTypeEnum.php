<?php

namespace App\Enums\Users;

enum UserTypeEnum: string
{
	case ADMIN = 'admin';
	case ARCHITECT = 'architect';
	case JOURNALIST = 'journalist';

	public function label(): string
    {
        return match($this)
        {
            self::ADMIN => 'Admin',
            self::ARCHITECT => 'Architect',
            self::JOURNALIST => 'Journalist',
        };
    }
}
