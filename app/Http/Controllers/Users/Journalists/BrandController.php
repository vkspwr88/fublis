<?php

namespace App\Http\Controllers\Users\Journalists;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
	{
		return view('users.pages.journalists.brands.index');
	}
}
