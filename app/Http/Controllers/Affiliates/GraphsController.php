<?php

namespace App\Http\Controllers\Affiliates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GraphsController extends Controller
{
    public function index(){
		return view('users.pages.affiliates.graphs');
	}
}
