<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public static function create($poly, $details)
	{
		$poly->create($details);
	}

	public static function updateOrCreate($poly, $details)
	{
		$poly->updateOrCreate(
			['image_type' => $details['image_type']],
			['image_path' => $details['image_path']],
		);
	}
}
