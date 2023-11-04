<?php

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
