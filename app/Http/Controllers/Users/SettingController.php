<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public static function getValue(string $key)
	{
		return Setting::where('setting_key', $key)
				->first()
				->setting_value;
	}
}
