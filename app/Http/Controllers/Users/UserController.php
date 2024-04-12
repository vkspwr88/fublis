<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public static function generateSlug($name)
	{
		$count = User::where('name', $name)->count();
		if($count > 1){
			$name .= $count;
		}
		return str()->replace(
							' ',
							'-',
							str()->headline($name)
						);
	}
}
