<?php

namespace App\Http\Controllers\Users\Architects;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public static function checkPremiumPublication($publication)
	{
		if( $publication->is_premium && !isSubscribed() ){
			/* $this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'Upgrade your plan to pitch premium publication.'
			]); */
			return true;
		}
		return false;
	}

	public static function checkPitchesPerMonth()
	{
		$mediaKits = auth()->user()->architect->mediaKits;
		$pitches = $mediaKits->load('pitch')->pluck('pitch')->flatten()->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
		// dd($pitches, $pitches->count() >= 3, !isSubscribed(), Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth());
		if( $pitches->count() >= 3 && !isSubscribed() ){
			return true;
		}
		return false;
	}
}
