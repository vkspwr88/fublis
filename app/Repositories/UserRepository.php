<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
	public function isEmailExist(string $email)
	{
		return User::where('email', $email)
					->first();
	}

	public function createUser(array $details): User
	{
		return User::create($details);
	}
}
