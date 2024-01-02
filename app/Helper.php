<?php

use App\Enums\Users\Architects\UserRoleEnum;
use App\Enums\Users\UserTypeEnum;
use Illuminate\Support\Arr;

if (!function_exists('filterFileName')) {
    function filterFileName($fileName)
    {
		return Arr::last(
			explode('/', $fileName)
		);
    }
}

if (!function_exists('isArchitect')) {
    function isArchitect()
    {
		return auth()->check() && auth()->user()->user_type === UserTypeEnum::ARCHITECT;
	}
}

if (!function_exists('isArchitectAdmin')) {
    function isArchitectAdmin()
    {
		return isArchitect() && auth()->user()->architect->user_role === UserRoleEnum::ADMIN;
	}
}

if (!function_exists('isJournalist')) {
    function isJournalist()
    {
		return auth()->check() && auth()->user()->user_type === UserTypeEnum::JOURNALIST;
	}
}

if (!function_exists('trimWebsiteUrl')) {
    function trimWebsiteUrl($url)
    {
		return str()->remove('http://', $url);
	}
}

if (!function_exists('showModelName')) {
    function showModelName($model)
    {
		return str()->headline(
					Arr::last(
						explode('\\', $model)
					)
				);
    }
}

if (!function_exists('getMediaKitViewUrl')) {
    function getMediaKitViewUrl($model, $id)
    {
		if($model === 'Press Release'){
			return route('architect.media-kit.press-release.view', ['mediaKit' => $id]);
		}
		if($model === 'Project'){
			return route('architect.media-kit.project.view', ['mediaKit' => $id]);
		}
		if($model === 'Article'){
			return route('architect.media-kit.article.view', ['mediaKit' => $id]);
		}
    }
}

if (!function_exists('checkInvitation')) {
    function checkInvitation($sender)
    {
		if(session()->has('sender') && session()->has('invitation') && session()->get('sender') == $sender){
			return true;
		}
		return false;
    }
}
