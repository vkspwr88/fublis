<?php

namespace App\Services;

use App\Http\Controllers\ErrorLogController;
use App\Http\Controllers\Users\Journalists\Profile\PostController as ProfilePostController;
use App\Http\Controllers\Users\PostController;
use Exception;
use Illuminate\Support\Facades\DB;

class JournalistPostService
{
	public function getJournalistPosts($journalist)
	{
		$posts = $journalist->posts->sortByDesc('created_at');
		//dd($posts);
		return PostController::loadModel($posts);
	}

	public function createPost(array $data)
	{
		try {
			DB::beginTransaction();
			ProfilePostController::create([
				'story_type' => $data['selectedStoryType'],
				'category_id' => $data['selectedCategory'],
				'publication_id' => $data['selectedPublication'],
				'post_url' => $data['postUrl'],
				'meta_title' => $data['metaTitle'],
				'meta_content' => $data['metaContent'],
				'journalist_id' => auth()->user()->journalist->id,
			]);
			DB::commit();
		} catch (Exception $exp) {
			DB::rollBack();
			ErrorLogController::logError(
				'createPost', [
					'line' => $exp->getLine(),
					'file' => $exp->getFile(),
					'message' => $exp->getMessage(),
					'code' => $exp->getCode(),
				]
			);
			return false;
		}
		return true;
	}
}
