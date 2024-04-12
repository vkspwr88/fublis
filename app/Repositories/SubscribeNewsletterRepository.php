<?php

namespace App\Repositories;

use App\Interfaces\SubscribeNewsletterRepositoryInterface;
use App\Models\SubscribeNewsletter;
use Illuminate\Support\Carbon;

class SubscribeNewsletterRepository implements SubscribeNewsletterRepositoryInterface
{
	public function isEmailVerified(string $email)
	{
		return SubscribeNewsletter::where('email', $email)
									->whereNotNull('email_verified_at')
									->where('is_unsubscribed', false)
									->first();
	}

	public function createSubscriber(array $details)
	{
		$subscriber = SubscribeNewsletter::updateOrCreate($details);
		$subscriber->updated_at = Carbon::now();
		$subscriber->save();
		return $subscriber;
	}

	public function verifySubscriber(string $token)
	{
		return SubscribeNewsletter::where('token', $token)
									->whereNull('email_verified_at')
									->update(['email_verified_at' => Carbon::now()]);
	}

	public function getSubscriberByToken(string $token)
	{
		return SubscribeNewsletter::where('token', $token)
									->first();
	}

	public function checkEmailSent(string $email)
	{
		$isEmailExist = SubscribeNewsletter::where([
												'email' => $email
											])->first();
		if(!$isEmailExist){
			return false;
		}
		/* SubscribeNewsletter::where([
			'email' => $email,
			['updated_at', '>=', Carbon::now()->subMinutes(10)]
		])->dd(); */
		return 	SubscribeNewsletter::where([
					'email' => $email,
					['updated_at', '>=', Carbon::now()->subMinutes(10)]
				])->first();
	}
}
