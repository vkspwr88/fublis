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
				'id' => 'App\Models\PressRelease',
				'name' => 'Press Releases',
			],
			[
				'id' => 'App\Models\Project',
				'name' => 'Projects',
			],
			[
				'id' => 'App\Models\Article',
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
