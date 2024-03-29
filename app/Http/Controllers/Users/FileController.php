<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public static function upload($file, $location)
	{
		/* $extension = strtolower($file->getClientOriginalExtension());
        $fileName = Str::ulid() . '.' . $extension;
        //$location = 'images/categories';
        $file->move($location, $fileName);
        return $location . '/' . $fileName; */
		if(Str::contains($file, $location)){
			return $file;
		}
		return Storage::putFile($location, $file, 'public');
		// Storage::delete('file.jpg');
	}

	public static function delete($path)
	{
		Storage::delete($path);
	}
}
