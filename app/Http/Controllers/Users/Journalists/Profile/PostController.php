<?php

namespace App\Http\Controllers\Users\Journalists\Profile;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public static function create(array $data)
	{
		return Post::create($data);
	}
}
