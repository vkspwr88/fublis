<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public static function loadModel($post){
		return $post->load([
			'journalist',
			'publication.profileImage',
			'category'
		]);
	}

	public static function getPostById(string $id)
	{
		return Post::find($id);
	}
}
