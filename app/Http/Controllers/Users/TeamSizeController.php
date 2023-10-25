<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\TeamSize;
use Illuminate\Http\Request;

class TeamSizeController extends Controller
{
    public static function getAll()
	{
		return TeamSize::all();
	}
}
