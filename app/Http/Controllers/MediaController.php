<?php

namespace App\Http\Controllers;

use Awcodes\Curator\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public static function getRecordById(int $id)
	{
		return Media::findOrFail($id);
	}
}
