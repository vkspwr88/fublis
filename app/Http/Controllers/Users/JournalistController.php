<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Journalist;
use Illuminate\Http\Request;

class JournalistController extends Controller
{
    public static function getJournalistById(string $id)
	{
		return Journalist::find($id);
	}
}
