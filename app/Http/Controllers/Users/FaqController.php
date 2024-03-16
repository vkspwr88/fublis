<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
	public static function getAll()
	{
		return Faq::all()->orderBy('sort_order');
	}
}
