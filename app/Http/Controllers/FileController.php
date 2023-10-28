<?php

namespace App\Http\Controllers;

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
		return Storage::putFile($location, $file);
		// Storage::delete('file.jpg');
	}

	public static function delete($path)
	{
		Storage::delete($path);
	}
}
