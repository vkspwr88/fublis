<?php

namespace App\Http\Controllers;

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
