<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Call;
use App\Models\PublicationType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PublicationTypeController extends Controller
{
    public static function getAll()
	{
		return PublicationType::all();
	}

	public static function getSelected($type)
	{
		if($type == 'journalist' || $type == 'publication'){
			return PublicationType::has('publications')
									->orderBy('name', 'asc')
									->get();
		}
		if($type == 'call'){
			// dd(Call::with('publication.publicationTypes')->get()->pluck('publication')->pluck('publicationTypes')->flatten()->unique()->pluck('id')/* where('submission_end_date', '>', Carbon::now()) */);
			return Call::with('publication.publicationTypes')
						->where('submission_end_date', '>', Carbon::now())
						->get()
						->pluck('publication')
						->pluck('publicationTypes')
						->flatten()
						->unique();
		}
	}
}
