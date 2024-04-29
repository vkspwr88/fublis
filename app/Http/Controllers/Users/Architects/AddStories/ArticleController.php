<?php

namespace App\Http\Controllers\Users\Architects\AddStories;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\ArchitectController;
use App\Http\Controllers\Users\Architects\MediaKitDraftController;
use App\Http\Controllers\Users\CategoryController;
use App\Http\Controllers\Users\ProjectAccessController;
use App\Models\MediaKitDraft;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
	{
		return view('users.pages.architects.add-stories.articles.index');
	}

	public function draft(MediaKitDraft $mediaKitDraft)
	{
		MediaKitDraftController::check($mediaKitDraft);
		return view('users.pages.architects.add-stories.articles.draft', [
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
		$mediaKit = [
			'id' => $mediaKitDraft->id,
			'story' => (object)[
				'title' => $content->articleTitle,
				'text_credits' => $content->textCredits,
				'cover_image_path' => $content->coverImage,
				'preview_text' => $content->previewText,
				'article_doc_path' => $content->articleFile,
				'article_doc_link' => $content->articleLink,
				'article_writeup' => $content->articleWrite,
				'company_profile_path' => $content->companyProfileFile,
				'company_profile_link' => $content->companyProfileLink,
				'images_link' => $content->coverImage,
				'images' => [],
				'draftImages' => $content->imagesFiles,
				'tags' => collect($content->tags),
			],
			'architect' => $mediaKitDraft->architect,
			'category' => CategoryController::findById($content->category),
			'audio_video_url' => $content->audioVideoUrl,
			'mediaContact' => ArchitectController::findById($content->mediaContact)->load('profileImage', 'position', 'user'),
			'mediaKitAccess' => ProjectAccessController::findById($content->mediaKitAccess),
		];
		return view('users.pages.architects.add-stories.articles.preview', [
			'mediaKit' => (object)$mediaKit,
		]);
	}
}
