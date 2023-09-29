<?php

namespace App\Repositories;

use App\Interfaces\SubscribeNewsletterRepositoryInterface;
use App\Models\SubscribeNewsletter;

class SubscribeNewsletterRepository implements SubscribeNewsletterRepositoryInterface
{
	public function isEmailExists(string $email){
		return SubscribeNewsletter::where([
			'email' => $email,
		])->first();
	}

	public function isEmailVerified(string $email)
	{
		/* return SubscribeNewsletter::where('email', $email)
									->where('email_verified_at', '!=', null)
									>first(); */
	}
}
