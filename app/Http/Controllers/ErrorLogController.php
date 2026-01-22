<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ErrorLogController extends Controller
{
    public static function logError(string $message, array $context)
	{
		info($message, $context);
	}

	public static function logErrorNew($functionName, $exp)
	{
		Log::error($exp->getMessage());
		info($functionName, [
			'line' => $exp->getLine(),
			'file' => $exp->getFile(),
			'message' => $exp->getMessage(),
			'code' => $exp->getCode(),
		]);
	}
}
