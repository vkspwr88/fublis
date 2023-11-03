<?php

namespace App\Http\Controllers\Users\Journalists;

use App\Http\Controllers\Controller;
use App\Models\Call;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function index()
	{
		$calls = Call::with(['journalist.user', 'publication', 'publication', 'tags'])->latest()->get();
		return view('users.pages.journalists.calls.index', [
			'calls' => $calls,
		]);
	}

	public function create()
	{
		return view('users.pages.journalists.calls.create');
	}

	public function edit(Call $call)
	{
		return view('users.pages.journalists.calls.edit', [
			'call' => $this->loadModel($call),
		]);
	}

	public function view(Call $call)
	{
		$this->loadModel($call);
		return view('users.pages.journalists.calls.view', [
			'title' => $call->title,
			'description' => $call->description,
			'submissionEndsDate' => $call->submission_end_date,
			'publication' => $call->publication,
			'category' => $call->category,
			'location' => $call->location,
			'language' => $call->language,
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
			'publication',
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
