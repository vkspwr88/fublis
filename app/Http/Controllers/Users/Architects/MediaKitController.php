<?php

namespace App\Http\Controllers\Users\Architects;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\MediaKit;
use App\Models\PressRelease;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class MediaKitController extends Controller
{
    public function index()
	{
		return view('users.pages.architects.media-kits.index');
	}

	public function view(MediaKit $mediaKit)
	{
		MediaKitController::check($mediaKit);
		if (str()->contains($mediaKit->story_type, 'PressRelease')){
			return to_route('architect.media-kit.press-release.view', ['mediaKit' => $mediaKit->slug]);
		}
		if (str()->contains($mediaKit->story_type, 'Article')){
			return to_route('architect.media-kit.article.view', ['mediaKit' => $mediaKit->slug]);
		}
		if (str()->contains($mediaKit->story_type, 'Project')){
			return to_route('architect.media-kit.project.view', ['mediaKit' => $mediaKit->slug]);
		}
	}

	public static function createMediaKit($poly, array $details)
	{
		$details = Arr::add(
						$details,
						'slug',
						MediaKitController::generateSlug($poly->title)
					);
		return $poly->mediakit()->create($details);
	}

	public static function generateSlug($name)
	{
		$count = MediaKit::whereHasMorph(
			'story',
			[PressRelease::class, Project::class, Article::class],
			function (Builder $query) use($name) {
				$query->where('title', $name);
			}
		)->count();
		if($count > 0){
			$name .= $count;
		}
		return str()->replace(
							' ',
							'-',
							str()->headline($name)
						);
	}

	public static function check($mediaKit)
	{
		if(!$mediaKit){
			return abort(404);
		}
	}

	public static function isAuthorized($mediaKit)
	{
		MediaKitController::check($mediaKit);
		if($mediaKit->architect_id != auth()->user()->architect->id){
			return abort(401);
		}
	}

	public static function findById(string $id)
	{
		return MediaKit::findOrFail($id);
	}
}
