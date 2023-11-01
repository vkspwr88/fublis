<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaKitController extends Controller
{
    public static function getAll()
	{
		return [
			[
				'id' => 'press-release',
				'name' => 'Press Releases',
			],
			[
				'id' => 'project',
				'name' => 'Projects',
			],
			[
				'id' => 'article',
				'name' => 'Articles',
			],
		];
	}
}
