<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorLogController extends Controller
{
    public static function logError(string $message, array $context)
	{
		info($message, $context);
	}

	public static function logErrorNew($functionName, $exp)
	{
		info($functionName, [
			'line' => $exp->getLine(),
			'file' => $exp->getFile(),
			'message' => $exp->getMessage(),
			'code' => $exp->getCode(),
		]);
	}
}
