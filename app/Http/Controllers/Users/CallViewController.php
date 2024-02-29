<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\CallView;
use Illuminate\Http\Request;

class CallViewController extends Controller
{
    public static function createCallView(array $data): ?CallView
	{
		return CallView::updateOrCreate($data);
	}
}
