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

	public function getInvitedArchitectUserById(string $id){
		return User::find($id)
					->load('architect.company');
	}

	public function getInvitedJournalistUserById(string $id){
		return User::find($id)
					->load('journalist.publications');
	}

	public function checkGoogleId(string $googleId)
	{
		return User::where('google_id', $googleId)
					->first();
	}
}
