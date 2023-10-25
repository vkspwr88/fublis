<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
	public function isEmailExist(string $email);
	public function createUser(array $details);
}
