<?php

namespace App\Http\Controllers\Users;

use App\Enums\Users\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Interview;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class InterviewController extends Controller
{
    public function index(Interview $interview)
	{
		if(!isArchitect() && !isJournalist()){
			if($interview->user_type === UserTypeEnum::ARCHITECT){
				session(['url.intended' => url()->current()]);
				return to_route('architect.signup');
			}
			elseif($interview->user_type === UserTypeEnum::JOURNALIST){
				session(['url.intended' => url()->current()]);
				return to_route('journalist.signup');
			}
			return to_route('home');
		}
		/* if($interview->user_id != auth()->id()){
			return abort(419);
		} */
		return view('users.pages.interviews.index', [
			'interview' => $interview,
			'SEOData' => new SEOData(
                title: $interview->heading,
            ),
		]);
	}
}
