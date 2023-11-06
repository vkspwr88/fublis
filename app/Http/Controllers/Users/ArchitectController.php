<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Architect;
use Illuminate\Http\Request;

class ArchitectController extends Controller
{
    public static function getArchitectDetailsByUserId(string $userId)
	{
		return Architect::with([
							'user',
							'profileImage',
							'position',
							'location',
							'company',
						])->where('user_id', $userId)
						->first();
	}
}
