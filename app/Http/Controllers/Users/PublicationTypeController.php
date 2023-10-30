<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\PublicationType;
use Illuminate\Http\Request;

class PublicationTypeController extends Controller
{
    public static function getAll()
	{
		return PublicationType::all();
	}
}
