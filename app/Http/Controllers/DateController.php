<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;

class DateController extends Controller
{
    public static function getDateRange($type)
	{
		$todayDate = CarbonImmutable::today();
		if($type == 'week'){
			$lastWeekDate = $todayDate->subDays(7);
			return [
				'from_date' => $lastWeekDate->startOfWeek(Carbon::MONDAY),
				'to_date' => $lastWeekDate->endOfWeek(Carbon::SUNDAY),
			];
		}
		if($type == 'month'){
			return [
				'from_date' => $todayDate->firstOfMonth(),
				'to_date' => $todayDate->lastOfMonth(),
			];
		}
	}
}
