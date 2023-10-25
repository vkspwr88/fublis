<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public static function getAll()
	{
		return Company::all();
	}

	public static function createCompany($details)
	{
		return Company::create($details);
	}
}
