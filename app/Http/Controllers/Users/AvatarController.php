<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Avatar;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AvatarController extends Controller
{
	private static $publicationColorArr = [
		'#c5bc84', '#dbae73', '#beaad7', '#b7b2a5', '#9d9d80', '#e59d91', '#c09a9c', '#90bcc1', '#7da6c4', '#c69875', '#a6b98b', '#8d96cb', '#9ba5b9', '#d0b49f', '#e29578', '#dbbb73',
	];
	private static $studioColorArr = [
		'#7F56D9',
	];
	private static $journalistColorArr = [
		'#c5bc84', '#dbae73', '#beaad7', '#b7b2a5', '#9d9d80', '#e59d91', '#c09a9c', '#90bcc1', '#7da6c4', '#c69875', '#a6b98b', '#8d96cb', '#9ba5b9', '#d0b49f', '#e29578', '#dbbb73',
	];
	private static $architectColorArr = [
		'#000000',
	];

    public static function setProfileAvatar($data, $theme = 'others')
	{
		return Avatar::create( Str::ucfirst(Str::camel($data['name'])) )
					->setTheme($theme)
					->setDimension($data['width'])
					->setFontSize($data['fontSize'])
					->setBackground($data['background'])
					->setForeground($data['foreground']);
	}

	public static function getBackground($type)
	{
		if($type == 'studio'){
			return Arr::shuffle(self::$studioColorArr)[0];
		}
		if($type == 'publication'){
			return Arr::shuffle(self::$publicationColorArr)[0];
		}
		if($type == 'journalist'){
			return Arr::shuffle(self::$journalistColorArr)[0];
		}
		if($type == 'architect'){
			return Arr::shuffle(self::$architectColorArr)[0];
		}
	}

	public static function getProfileAvatar($model, $type)
	{
		if($type == 'studio'){
			return $model->profileImage ?
						Storage::url($model->profileImage->image_path) :
						AvatarController::setProfileAvatar([
							'name' => $model->name,
							'width' => 150,
							'fontSize' => 60,
							'background' => $model->background_color,
							'foreground' => $model->foreground_color,
						]);
		}
		if($type == 'publication'){
			return $model->profileImage ?
						Storage::url($model->profileImage->image_path) :
						AvatarController::setProfileAvatar([
							'name' => $model->name,
							'width' => 150,
							'fontSize' => 60,
							'background' => $model->background_color,
							'foreground' => $model->foreground_color,
						], 'publication');
		}
		if($type == 'journalist' || $type == 'architect'){
			return $model->profileImage ?
						Storage::url($model->profileImage->image_path) :
						AvatarController::setProfileAvatar([
							'name' => $model->user->name,
							'width' => 150,
							'fontSize' => 60,
							'background' => $model->background_color,
							'foreground' => $model->foreground_color,
						]);
		}
		/* if($type == 'architect'){
			return Arr::shuffle(self::$architectColorArr)[0];
		} */
	}
}
