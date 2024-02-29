<?php

namespace App\Http\Controllers\Users\Journalists;

use App\Http\Controllers\Controller;
use App\Models\Call;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function index()
	{
		$calls = Call::whereHas('journalist', function (Builder $query) {
						$query->where('user_id', auth()->id());
					})
					->with([
						'journalist.user',
						'publication.profileImage',
						'tags',
						'location',
						'category',
						'language',
					])
					->latest()
					->get();
		return view('users.pages.journalists.calls.index', [
			'calls' => $calls,
		]);
	}

	public function all()
	{
		/* $calls = Call::with([
						'journalist.user',
						'publication.profileImage',
						'tags',
						'location',
						'category',
						'language',
					])
					->latest()
					->get();
		return view('users.pages.journalists.calls.all', [
			'calls' => $calls,
		]); */
		return view('users.pages.journalists.calls.all');
	}

	public function create()
	{
		return view('users.pages.journalists.calls.create');
	}

	public function edit(Call $call)
	{
		if($call->journalist->user_id === auth()->id()){
			return view('users.pages.journalists.calls.edit', [
				'call' => $this->loadModel($call),
			]);
		}
		return abort(401);
	}

	public function view(Call $call)
	{
		$this->loadModel($call);
		// $city = $call->location->city()->first();
		return view('users.pages.journalists.calls.view', [
			'title' => $call->title,
			'submittedBy' => auth()->user()->name,
			'description' => $call->description,
			'submissionEndsDate' => $call->submission_end_date,
			'publication' => $call->publication,
			'category' => $call->category,
			// 'location' => $call->location,
			// 'selectedCity' => $call->location->name,
			// 'selectedStateName' => $city->state->name,
			'selectedCountry' => $call->location->name,
			'language' => $call->language,
			'publishFrom' => $call->publishFrom,
			'call' => $call,
		]);
	}

	public function loadModel($call)
	{
		return $call->load([
			'journalist' => [
				'user',
			],
			'category',
			'location',
			'language',
			'publication' => [
				'profileImage'
			],
			'publishFrom',
			'tags',
		]);
	}

	public static function findById(string $id)
	{
		return Call::find($id);
	}

	public static function createCall(array $details)
	{
		return Call::create($details);
	}

	public static function updateCall(string $callId, array $details)
	{
		Call::where('id', $callId)
					->update($details);

		return CallController::findById($callId);
	}

	/* public static function getCallsByJournalistId */
}
