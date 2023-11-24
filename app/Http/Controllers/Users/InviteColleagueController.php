<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\InviteColleague;
use Illuminate\Http\Request;

class InviteColleagueController extends Controller
{
    public static function create(array $data)
	{
		return InviteColleague::create($data);
	}
}
