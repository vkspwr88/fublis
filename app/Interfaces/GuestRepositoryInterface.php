<?php

namespace App\Interfaces;

use App\Models\Guest;

interface GuestRepositoryInterface
{
	public function createGuest(array $details): Guest;
	public function getGuestById(string $id): Guest;
}
