<?php

namespace App\Http\Controllers\Users\Architects\AddStories;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\ArchitectController;
use App\Http\Controllers\Users\Architects\MediaKitDraftController;
use App\Http\Controllers\Users\CategoryController;
use App\Models\MediaKitDraft;
use Illuminate\Http\Request;

class PressReleaseController extends Controller
{
    public function index(){
		return view('users.pages.architects.add-stories.press-releases.index');
	}

	/* public function success(){
		return view('users.pages.architects.add-stories.press-release-success');
	} */

	public function draft(MediaKitDraft $mediaKitDraft)
	{
		MediaKitDraftController::check($mediaKitDraft);
		return view('users.pages.architects.add-stories.press-releases.draft', [
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
		/* $mediaKit = [
			'downloadRequests',
			'story' => [
				'title',
				'photographs',
				'tags',
			],
			'category',
			'architect' => [
				'company' => [
					'profileImage'
				],
				'profileImage',
				'user',
				'position'
			],
			'mediaContact' => [
				'user',
				'profileImage',
				'position',
			],
			'projectAccess',
		]; */
		// $category = CategoryController::findById($content->category);
		// $mediaContact = ArchitectController::findById($content->mediaContact)->load('profileImage', 'position', 'user');
		$mediaKit = [
			'id' => $mediaKitDraft->id,
			'story' => (object)[
				'title' => $content->pressReleaseTitle,
				'press_release_writeup' => $content->pressReleaseWrite,
				'cover_image_path' => $content->coverImage,
				'press_release_doc_path' => $content->coverImage,
				'press_release_doc_link' => $content->coverImage,
				'photographs_link' => $content->coverImage,
				'photographs' => [],
				'draftPhotographs' => $content->photographsFiles,
				'tags' => collect($content->tags),
			],
			'architect' => $mediaKitDraft->architect,
			'category' => CategoryController::findById($content->category),
			'mediaContact' => ArchitectController::findById($content->mediaContact)->load('profileImage', 'position', 'user'),
		];
		// dd((object)$mediaKit, $mediaKitDraft, $content);
		return view('users.pages.architects.add-stories.press-releases.preview', [
			'mediaKit' => (object)$mediaKit,
		]);
	}
}
