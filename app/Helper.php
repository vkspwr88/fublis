<?php

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
