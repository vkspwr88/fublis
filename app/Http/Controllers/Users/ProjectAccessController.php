<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\ProjectAccess;
use Illuminate\Http\Request;

class ProjectAccessController extends Controller
{
    public static function getAll()
	{
		return ProjectAccess::all();
	}
	public static function findById(string $id)
	{
		return ProjectAccess::find($id);
	}
}
