<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\PublishFrom;
use Illuminate\Http\Request;

class PublishFromController extends Controller
{
    public static function getAll()
	{
		return PublishFrom::all();
	}

	public static function findById(string $id)
	{
		return PublishFrom::find($id);
	}
}
