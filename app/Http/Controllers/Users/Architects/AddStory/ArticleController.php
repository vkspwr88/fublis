<?php

namespace App\Http\Controllers\Users\Architects\AddStory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(){
		return view('users.pages.architect.add-story.article');
	}
}
