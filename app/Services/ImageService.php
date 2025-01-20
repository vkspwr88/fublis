<?php

namespace App\Services;

class ImageService
{
	public function removeProfileImage($model)
	{
		$model->profileImage()->delete();
	}
}
