<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\JournalistPosition;
use Illuminate\Http\Request;

class JournalistPositionController extends Controller
{
    public static function getAll()
	{
		return JournalistPosition::all();
	}
}
