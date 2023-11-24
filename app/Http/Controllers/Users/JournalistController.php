<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Journalist;
use Illuminate\Http\Request;

class JournalistController extends Controller
{
    public static function getJournalistById(string $id)
	{
		return Journalist::find($id);
	}

	public static function loadModel($model)
	{
		return $model->load([
						'user',
						'profileImage',
						'language',
						'location',
						'publications' => [
							'profileImage',
							'categories'
						],
						'associatedPublications' => [
							'profileImage',
							'categories'
						],
					]);
	}
}
