<?php

namespace App\Http\Controllers\Users\Architects\PitchStories;

use App\Http\Controllers\Controller;
use App\Models\Call;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function index()
	{
		return view('users.pages.architects.pitch-story.call.index');
	}

	public function view(Call $call)
	{
		$call->load([
			'journalist' => [
				'user',
			],
			'category',
			'location',
			'language',
			'publishFrom',
			'publication' => [
				'profileImage'
			],
			'tags',
		]);
		$city = $call->location->city()->first()->load('state.country');
		return view('users.pages.architects.pitch-story.call.view', [
			'call' => $call,
			'title' => $call->title,
			'submittedBy' => $call->journalist->user->name,
			'description' => $call->description,
			'submissionEndsDate' => $call->submission_end_date,
			'publication' => $call->publication,
			'publishFrom' => $call->publishFrom,
			'category' => $call->category,
			'selectedCity' => $call->location->name,
			'selectedStateName' => $city->state->name,
			'selectedCountryName' => $city->state->country->name,
			'location' => $call->location,
			'language' => $call->language,
		]);
	}
}
