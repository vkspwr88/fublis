<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\InviteColleague;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function index(InviteColleague $invitation, string $type)
	{
		if(!$invitation){
			return abort(404);
		}
		session()->put('sender', $type);
		session()->put('invitation', $invitation);
		if($type == 'architect'){
			return to_route('architect.signup');
		}
		elseif($type == 'journalist'){
			return to_route('journalist.signup');
		}
		return to_route('home');
	}
}
