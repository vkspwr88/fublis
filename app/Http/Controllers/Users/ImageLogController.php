<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\ImageLog;
use Illuminate\Http\Request;

class ImageLogController extends Controller
{
    public static function create($details)
	{
		ImageLog::updateOrCreate($details);
	}
}
