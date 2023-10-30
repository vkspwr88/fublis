<?php

use App\Enums\Users\UserTypeEnum;
use Illuminate\Support\Arr;

if (!function_exists('filterFileName')) {
    function filterFileName($fileName)
    {
		return Arr::last(
			explode('/', $fileName)
		);
		/* $fileName = explode('/', $fileName);
		dd(Arr::last($fileName));
		$filter = json_decode($fileName);
		$filter = str_replace( ['"', '{', '}'], '', $filter);
		$filter = str_replace( ':', ': ', $filter);
		$filter = str_replace( ',', ', ', $filter);
        return $filter; */
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
