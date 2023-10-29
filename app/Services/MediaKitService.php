<?php

namespace App\Services;

use App\Models\Architect;
use App\Models\MediaKit;

class MediaKitService
{
	private Architect $architect;

	public function __construct()
	{
		$this->architect = auth()->user()->architect;
	}

	public function filterMediaKits(array $mediaKitTypes, array $categories)
	{
		if(empty($mediaKitTypes) && empty($categories)){
			return MediaKit::with(['story', 'category', 'architect.company'])
				->where('architect_id', $this->architect->id)
				->latest()
				->get();
		}
	}
}
