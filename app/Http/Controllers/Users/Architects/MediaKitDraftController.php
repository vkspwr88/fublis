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
		$mediaKitDraft = MediaKitDraftController::findById($id);
		MediaKitDraftController::check($mediaKitDraft);
		$mediaKitDraft->delete();
	}

	public static function update(string $id, array $details)
	{
		// dd($details);
		$details = MediaKitDraftController::setDetails($details);
		$mediaKitDraft = MediaKitDraftController::findById($id);
		$mediaKitDraft->update($details);
		return $mediaKitDraft;
	}

	public static function checkFile($file, $path, $type = '')
	{
		if($file){
			return FileController::upload($file, $path, $type);
		}
		return $file;
	}

	public static function setDetails(array $details)
	{
		$content = $details['content'];
		if($details['media_kit_type'] == 'press-release'){
			$content['coverImage'] = MediaKitDraftController::checkFile($content['coverImage'], 'images/press-releases/cover-images', 'press_release_cover_image_draft');
			$content['pressReleaseFile'] = MediaKitDraftController::checkFile($content['pressReleaseFile'], 'documents/press-releases', 'press_release_doc_draft');
			if(count($content['photographsFiles']) > 0){
				$photographsFiles = $content['photographsFiles'];
				$content['photographsFiles'] = array();
				foreach($photographsFiles as $photograph){
					$content['photographsFiles'][] = MediaKitDraftController::checkFile($photograph, 'images/press-releases/photographs', 'press_release_photographs_draft');
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
					'pressReleaseLink' => $content['pressReleaseLink'],
					'photographsFiles' => $content['photographsFiles'],
					'photographsLink' => $content['photographsLink'],
					'audioVideoUrl' => $content['audioVideoUrl'],
					'tags' => $content['tags'],
					'mediaContact' => $content['mediaContact'],
					'mediaKitAccess' => $content['mediaKitAccess'],
				]),
			];
		}
		elseif($details['media_kit_type'] == 'project'){
			$content['coverImage'] = MediaKitDraftController::checkFile($content['coverImage'], 'images/projects/cover-images', 'project_cover_image_draft');
			$content['projectFile'] = MediaKitDraftController::checkFile($content['projectFile'], 'documents/projects', 'project_doc_draft');
			if(count($content['photographsFiles']) > 0){
				$photographsFiles = $content['photographsFiles'];
				$content['photographsFiles'] = array();
				foreach($photographsFiles as $image){
					$content['photographsFiles'][] = MediaKitDraftController::checkFile($image, 'images/projects/photographs', 'project_photographs_draft');
				}
			}
			if(count($content['drawingsFiles']) > 0){
				$drawingsFiles = $content['drawingsFiles'];
				$content['drawingsFiles'] = array();
				foreach($drawingsFiles as $image){
					$content['drawingsFiles'][] = MediaKitDraftController::checkFile($image, 'images/projects/drawings', 'project_drawings_draft');
				}
			}
			$newDetails = [
				'media_kit_type' => $details['media_kit_type'],
				'architect_id' => $details['architect_id'],
				'content' => json_encode([
					'projectTitle' => $content['projectTitle'],
					'category' => $content['category'],
					'siteArea' => $content['siteArea'],
					'siteAreaUnit' => $content['siteAreaUnit'],
					'builtUpArea' => $content['builtUpArea'],
					'builtUpAreaUnit' => $content['builtUpAreaUnit'],
					'materials' => $content['materials'],
					'buildingTypology' => $content['buildingTypology'],
					'buildingUse' => $content['buildingUse'],
					'selectedCountry' => $content['selectedCountry'],
					'selectedState' => $content['selectedState'],
					'selectedCity' => $content['selectedCity'],
					'status' => $content['status'],
					'imageCredits' => $content['imageCredits'],
					'textCredits' => $content['textCredits'],
					'renderCredits' => $content['renderCredits'],
					'consultants' => $content['consultants'],
					'designTeam' => $content['designTeam'],
					'coverImage' => $content['coverImage'],
					'projectBrief' => $content['projectBrief'],
					'projectFile' => $content['projectFile'],
					'projectLink' => $content['projectLink'],
					'photographsFiles' => $content['photographsFiles'],
					'photographsLink' => $content['photographsLink'],
					'drawingsFiles' => $content['drawingsFiles'],
					'drawingsLink' => $content['drawingsLink'],
					'audioVideoUrl' => $content['audioVideoUrl'],
					'tags' => $content['tags'],
					'mediaContact' => $content['mediaContact'],
					'mediaKitAccess' => $content['mediaKitAccess'],
				]),
			];
		}
		elseif($details['media_kit_type'] == 'article'){
			$content['coverImage'] = MediaKitDraftController::checkFile($content['coverImage'], 'images/articles/cover-images', 'article_cover_image_draft');
			$content['articleFile'] = MediaKitDraftController::checkFile($content['articleFile'], 'documents/articles', 'article_doc_draft');
			$content['companyProfileFile'] = MediaKitDraftController::checkFile($content['companyProfileFile'], 'documents/articles/company-profiles', 'article_company_profile_draft');
			if(count($content['imagesFiles']) > 0){
				$imagesFiles = $content['imagesFiles'];
				$content['imagesFiles'] = array();
				foreach($imagesFiles as $image){
					$content['imagesFiles'][] = MediaKitDraftController::checkFile($image, 'images/articles/images', 'article_images_draft_draft');
				}
			}
			$newDetails = [
				'media_kit_type' => $details['media_kit_type'],
				'architect_id' => $details['architect_id'],
				'content' => json_encode([
					'coverImage' => $content['coverImage'],
					'articleTitle' => $content['articleTitle'],
					'textCredits' => $content['textCredits'],
					'category' => $content['category'],
					'previewText' => $content['previewText'],
					'articleWrite' => $content['articleWrite'],
					'articleFile' => $content['articleFile'],
					'articleLink' => $content['articleLink'],
					'companyProfileFile' => $content['companyProfileFile'],
					'companyProfileLink' => $content['companyProfileLink'],
					'imagesFiles' => $content['imagesFiles'],
					'imagesLink' => $content['imagesLink'],
					'audioVideoUrl' => $content['audioVideoUrl'],
					'tags' => $content['tags'],
					'mediaContact' => $content['mediaContact'],
					'mediaKitAccess' => $content['mediaKitAccess'],
				]),
			];
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
