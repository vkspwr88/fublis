<?php

namespace App\Http\Controllers\Users\Journalists\Accounts\Profile;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class PublicationController extends Controller
{
	public function index()
	{
		return view('users.pages.journalists.accounts.profile.publications.index');
	}

    public function view(Publication $publication)
	{
		if(!$publication){
			return abort(404);
		}
		return view('users.pages.journalists.accounts.profile.publications.view', [
			'publication' => $publication,
			'SEOData' => new SEOData(
                title: $publication->name . ' Profile',
            ),
		]);
	}
}
