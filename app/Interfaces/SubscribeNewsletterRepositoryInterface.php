<?php

namespace App\Interfaces;

interface SubscribeNewsletterRepositoryInterface
{
	public function isEmailVerified(string $email);
	public function createSubscriber(array $details);
	public function verifySubscriber(string $token);
	public function getSubscriberByToken(string $token);
	public function checkEmailSent(string $email);
}
