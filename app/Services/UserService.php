<?php

namespace App\Services;

use App\Models\User;

class UserService
{
	public static function getUserByID(string $id)
	{
		return User::find($id);
	}
}
