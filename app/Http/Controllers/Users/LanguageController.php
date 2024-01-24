<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public static function getAll()
	{
		return Language::all();
	}

	public static function findById(string $id)
	{
		return Language::find($id);
	}

	public static function findByName(string $name)
	{
		return Language::where('name', $name)->first();
	}
}
