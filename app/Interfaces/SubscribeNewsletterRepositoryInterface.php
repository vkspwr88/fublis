<?php

namespace App\Interfaces;

interface SubscribeNewsletterRepositoryInterface
{
	public function isEmailExists(string $email);
	public function isEmailVerified(string $email);
}
