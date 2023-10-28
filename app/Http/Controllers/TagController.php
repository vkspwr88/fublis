<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public static function attachTags($model, $tags){
		$tagIds = [];
		foreach($tags as $tagName){
			$tag = Tag::firstOrCreate([
				'name' => $tagName,
			]);
			$tagIds[] = $tag->id;
		}
		$model->tags()->syncWithPivotValues($tagIds, ['tagged_date' => Carbon::now()]);
	}
}
