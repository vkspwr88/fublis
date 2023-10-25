<?php

namespace App\Http\Controllers\Users\Architects;

use App\Http\Controllers\Controller;
use App\Models\ArchitectPosition;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public static function getAll()
	{
		return ArchitectPosition::all();
	}
}
