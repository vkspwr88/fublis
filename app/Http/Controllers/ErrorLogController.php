<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorLogController extends Controller
{
    public static function logError(string $message, array $context)
	{
		info($message, $context);
	}
}
