<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
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
}
