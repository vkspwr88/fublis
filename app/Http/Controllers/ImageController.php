<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public static function create($poly, $details)
	{
		$poly->create($details);
	}
}
