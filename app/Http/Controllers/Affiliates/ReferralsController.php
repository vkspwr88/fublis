<?php

namespace App\Http\Controllers\Affiliates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReferralsController extends Controller
{
    public function index(){
		return view('users.pages.affiliates.referrals');
	}
}
