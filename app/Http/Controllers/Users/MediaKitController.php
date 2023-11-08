<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\MediaKit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MediaKitController extends Controller
{
    public static function getAll()
	{
		return [
			[
				'id' => 'press-release',
				'name' => 'Press Releases',
			],
			[
				'id' => 'project',
				'name' => 'Projects',
			],
			[
				'id' => 'article',
				'name' => 'Articles',
			],
		];
	}

	public static function getUserMediaKitsAnalytics(string $userId)
	{
		return MediaKit::whereHas('architect', function (Builder $query) use ($userId) {
							$query->where('user_id', $userId);
						})->with(['story', 'analytics'])
						->withCount([
							'analytics as view_count' => function (Builder $query) {
								$query->where('data_type', 'App\Models\MediaKitView');
							},
							'analytics as download_count' => function (Builder $query) {
								$query->where('data_type', 'App\Models\MediaKitDownload');
							},
						])
						->get();
	}
}
