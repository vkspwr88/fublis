<?php

namespace App\Services;

use App\Models\FublisJournalist;
use App\Models\User;

class FublisJournalistService
{
	public static function getAll()
	{
		return FublisJournalist::with('journalist')->get();
	}
}
