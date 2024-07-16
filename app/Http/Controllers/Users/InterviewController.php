<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class InterviewController extends Controller
{
    public function index(Interview $interview)
	{
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
