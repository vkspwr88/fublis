<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
	public function isEmailExist(string $email);
}
