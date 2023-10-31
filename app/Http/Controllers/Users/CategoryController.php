<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public static function getAll()
	{
		return Category::all();
	}

	public static function findById(string $id)
	{
		return Category::find($id);
	}
}
