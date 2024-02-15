<?php

namespace App\Http\Controllers\Users\Architects\AddStories;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\ArchitectController;
use App\Http\Controllers\Users\Architects\MediaKitDraftController;
use App\Http\Controllers\Users\AreaController;
use App\Http\Controllers\Users\BuildingUseController;
use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\LocationController;
use App\Http\Controllers\Users\ProjectAccessController;
use App\Models\MediaKitDraft;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
	{
		return view('users.pages.architects.add-stories.projects.index');
	}

	public function draft(MediaKitDraft $mediaKitDraft)
	{
		MediaKitDraftController::check($mediaKitDraft);
		return view('users.pages.architects.add-stories.projects.draft', [
			'mediaKitDraft' => $mediaKitDraft,
		]);
	}

	public function preview(MediaKitDraft $mediaKitDraft)
	{
		MediaKitDraftController::check($mediaKitDraft);
		$mediaKitDraft->load([
			'architect' => [
				'user',
				'company.profileImage',
			],
		]);
		$content = json_decode($mediaKitDraft->content);
		// dd(LocationController::findByName($content->selectedCity));
		$mediaKit = [
			'id' => $mediaKitDraft->id,
			'story' => (object)[
				'title' => $content->projectTitle,
				'text_credits' => $content->textCredits,
				'cover_image_path' => $content->coverImage,
				'project_brief' => $content->projectBrief,
				// 'location' => $content->selectedCity,
				'location' => LocationController::findByName($content->selectedCity),
				'site_area' => $content->siteArea,
				'siteAreaUnit' => AreaController::findById($content->siteAreaUnit),
				'built_up_area' => $content->builtUpArea,
				'builtUpAreaUnit' => AreaController::findById($content->builtUpAreaUnit),
				'buildingUse' => BuildingUseController::findById($content->buildingUse),
				'text_credits' => $content->textCredits,
				'image_credits' => $content->imageCredits,
				'design_team' => $content->designTeam,
				'project_doc_path' => $content->projectFile,
				'project_doc_link' => $content->projectLink,
				'photographs_link' => $content->photographsLink,
				'photographs' => [],
				'draftPhotographs' => $content->photographsFiles,
				'drawings_link' => $content->drawingsLink,
				'drawings' => [],
				'draftDrawings' => $content->drawingsFiles,
				'tags' => collect($content->tags),
			],
			'architect' => $mediaKitDraft->architect,
			'category' => CategoryController::findById($content->category),
			'mediaContact' => ArchitectController::findById($content->mediaContact)->load('profileImage', 'position', 'user'),
			'mediaKitAccess' => ProjectAccessController::findById($content->mediaKitAccess),
		];
		return view('users.pages.architects.add-stories.projects.preview', [
			'mediaKit' => (object)$mediaKit,
		]);
	}
}
