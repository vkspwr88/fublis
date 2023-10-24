<?php

namespace App\Repositories;

use App\Interfaces\GuestRepositoryInterface;
use App\Models\Guest;

class GuestRepository implements GuestRepositoryInterface
{
	public function createGuest(array $details): Guest
	{
		$details['email_otp'] = rand(1000, 9999);
		return Guest::create($details);
	}

	public function getGuestById(string $id): Guest
	{
		return Guest::find($id);
	}
}
