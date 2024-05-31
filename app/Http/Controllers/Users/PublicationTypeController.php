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
			// dd(PublicationType::has('publications.calls')->orderBy('name', 'asc')->get());
			// dd(Call::with('publication.publicationTypes')->where('submission_end_date', '>', Carbon::now())->get()->pluck('publication')->unique()->flatten()->pluck('publicationTypes')->flatten()->unique('name'));
			return Call::with('publication.publicationTypes')
						->where('submission_end_date', '>', Carbon::now())
						->get()
						->pluck('publication')
						->flatten()
						->pluck('publicationTypes')
						->flatten()
						->unique('name')
						->sortBy('name');
		}
	}
}
