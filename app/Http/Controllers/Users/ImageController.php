<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

	public static function delete($poly, $childId)
	{
		$image = Image::find($childId);
		// dd($image);
		// $path = $image->image_path;
		$image->delete();
		// ImageController::deleteFile($path);
	}

	public static function deleteFile($path)
	{
		// Storage::delete($path);
	}
}
