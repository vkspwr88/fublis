<?php

namespace App\Http\Controllers\Users\Architects;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\FileController;
use App\Models\MediaKitDraft;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MediaKitDraftController extends Controller
{
	public function index()
	{
		return view('users.pages.architects.add-stories.drafts.index');
	}

	public function view(MediaKitDraft $mediaKitDraft)
	{
		MediaKitDraftController::check($mediaKitDraft);
		if($mediaKitDraft->media_kit_type === 'press-release'){
			return to_route('architect.add-story.press-release.draft', ['mediaKitDraft' => $mediaKitDraft->id]);
		}
		if($mediaKitDraft->media_kit_type === 'project'){
			return to_route('architect.add-story.project.draft', ['mediaKitDraft' => $mediaKitDraft->id]);
		}
		if($mediaKitDraft->media_kit_type === 'article'){
			return to_route('architect.add-story.article.draft', ['mediaKitDraft' => $mediaKitDraft->id]);
		}
	}

    public static function create(array $details)
	{
		$details = MediaKitDraftController::setDetails($details);
		return MediaKitDraft::create($details);
	}

	public static function findById(string $id)
	{
		return MediaKitDraft::findOrFail($id);
	}

	public static function deleteById(string $id)
	{
		return MediaKitDraft::findById($id)->delete();
	}

	public static function update(string $id, array $details)
	{
		// dd($details);
		$details = MediaKitDraftController::setDetails($details);
		$mediaKitDraft = MediaKitDraftController::findById($id);
		$mediaKitDraft->update($details);
		return $mediaKitDraft;
	}

	public static function checkFile($file, $path)
	{
		if($file){
			return FileController::upload($file, $path);
		}
		return $file;
	}

	public static function setDetails(array $details)
	{
		$content = $details['content'];
		if($details['media_kit_type'] == 'press-release'){
			$content['coverImage'] = MediaKitDraftController::checkFile($content['coverImage'], 'images/press-releases/cover-images');
			$content['pressReleaseFile'] = MediaKitDraftController::checkFile($content['pressReleaseFile'], 'documents/press-releases');
			if(count($content['photographsFiles']) > 0){
				$photographsFiles = $content['photographsFiles'];
				$content['photographsFiles'] = array();
				foreach($photographsFiles as $photograph){
					$content['photographsFiles'][] = MediaKitDraftController::checkFile($photograph, 'images/press-releases/photographs');
				}
			}
			$newDetails = [
				'media_kit_type' => $details['media_kit_type'],
				'architect_id' => $details['architect_id'],
				'content' => json_encode([
					'coverImage' => $content['coverImage'],
					'pressReleaseTitle' => $content['pressReleaseTitle'],
					'imageCredits' => $content['imageCredits'],
					'category' => $content['category'],
					'conceptNote' => $content['conceptNote'],
					'pressReleaseWrite' => $content['pressReleaseWrite'],
					'pressReleaseFile' => $content['pressReleaseFile'],
					'pressReleaseLink' => $content['pressReleaseLink'] ? 'http://' . $content['pressReleaseLink'] : null,
					'photographsFiles' => $content['photographsFiles'],
					'photographsLink' => $content['photographsLink'] ? 'http://' . $content['photographsLink'] : null,
					'tags' => $content['tags'],
					'mediaContact' => $content['mediaContact'],
					'mediaKitAccess' => $content['mediaKitAccess'],
				]),
			];
		}
		elseif($details['media_kit_type'] == 'project'){

		}
		elseif($details['media_kit_type'] == 'article'){

		}
		return $newDetails;
	}

	public static function check($mediaKitDraft)
	{
		if(!$mediaKitDraft){
			return abort(404);
		}
		if($mediaKitDraft->architect_id != auth()->user()->architect->id){
			return abort(401);
		}
	}

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

	public static function filter(array $data)
	{
		$mediaKits = MediaKitDraft::with(['architect.company'])
								->where('architect_id', auth()->user()->architect->id)
								->latest()
								->get();

		if(!empty($data['mediaKitTypes'])){
			$mediaKits = $mediaKits->whereIn('media_kit_type', $data['mediaKitTypes']);
		}

		if(!empty($data['categories'])){
			$mediaKits = $mediaKits->whereIn('category_id', $data['categories']);
		}
		
		// dd($data, $mediaKits);
		return $mediaKits;

	}
}
