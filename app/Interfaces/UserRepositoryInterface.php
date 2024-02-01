<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
	public function isEmailExist(string $email);
	public function isUserExist(array $details);
	public function createUser(array $details);
	public function getInvitedArchitectUserById(string $id);
	public function getInvitedJournalistUserById(string $id);
	public function checkGoogleId($googleId);
}
