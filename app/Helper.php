<?php

use App\Enums\Users\Architects\UserRoleEnum;
use App\Enums\Users\UserTypeEnum;
use Illuminate\Support\Arr;
use App\Models;
use Carbon\Carbon;

if (!function_exists('filterFileName')) {
    function filterFileName($fileName)
    {
		return Arr::last(
			explode('/', $fileName)
		);
    }
}

if (!function_exists('isArchitect')) {
    function isArchitect()
    {
		return auth()->check() && auth()->user()->user_type === UserTypeEnum::ARCHITECT;
	}
}

if (!function_exists('isArchitectAdmin')) {
    function isArchitectAdmin()
    {
		return isArchitect() && (auth()->user()->architect->user_role === UserRoleEnum::ADMIN || auth()->user()->architect->user_role === UserRoleEnum::SUPERADMIN);
	}
}

if (!function_exists('isJournalist')) {
    function isJournalist()
    {
		return auth()->check() && auth()->user()->user_type === UserTypeEnum::JOURNALIST;
	}
}

if (!function_exists('trimWebsiteUrl')) {
    function trimWebsiteUrl($url)
    {
		$url = str()->remove('https://', $url);
		$url = str()->remove('http://', $url);
		return $url;
	}
}

if (!function_exists('showModelName')) {
    function showModelName($model)
    {
		return str()->headline(
					Arr::last(
						explode('\\', $model)
					)
				);
    }
}

if (!function_exists('getProjectBrief')) {
	function getProjectBrief($mediaKit)
	{
		$type = showModelName($mediaKit->story_type);
		if($type === 'Press Release'){
			return $mediaKit->story->concept_note;
		}
		elseif($type === 'Article'){
			return $mediaKit->story->preview_text;
		}
		elseif($type === 'Project'){
			return $mediaKit->story->project_brief;
		}
	}
}

if (!function_exists('getMediaKitViewUrl')) {
    function getMediaKitViewUrl($model, $id)
    {
		if($model === 'Press Release'){
			return route('architect.media-kit.press-release.view', ['mediaKit' => $id]);
		}
		if($model === 'Project'){
			return route('architect.media-kit.project.view', ['mediaKit' => $id]);
		}
		if($model === 'Article'){
			return route('architect.media-kit.article.view', ['mediaKit' => $id]);
		}
    }
}

if (!function_exists('checkInvitation')) {
    function checkInvitation($sender)
    {
		if(session()->has('sender') && session()->has('invitation') && session()->get('sender') == $sender){
			return true;
		}
		return false;
    }
}

if (!function_exists('getArchitectNotificationType')) {
	function getArchitectNotificationType($model)
	{
		if ($model instanceof Models\Analytic){
			return 'users.includes.architect.notification.mediakit-view-notification';
		}
		elseif ($model instanceof Models\DownloadRequest){
			return 'users.includes.architect.notification.mediakit-download-request-notification';
		}
		elseif ($model instanceof Models\ChatMessage){
			return 'users.includes.architect.notification.receive-chat-message-notification';
		}
		elseif ($model instanceof Models\InviteColleague){
			return 'users.includes.architect.notification.team-added-notification';
		}
	}
}

if (!function_exists('getJournalistNotificationType')) {
	function getJournalistNotificationType($model)
	{
		if ($model instanceof Models\DownloadRequest){
			return 'users.includes.journalist.notification.mediakit-download-response-notification';
		}
		elseif ($model instanceof Models\ChatMessage){
			return 'users.includes.journalist.notification.receive-chat-message-notification';
		}
		elseif ($model instanceof Models\Chat){
			return 'users.includes.journalist.notification.receive-chat-notification';
		}
		elseif ($model instanceof Models\Pitch){
			return'users.includes.journalist.notification.receive-media-kit-notification';
		}
	}
}

if (!function_exists('formatDate')) {
	function formatDate($date)
	{
		return Carbon::parse($date)->format('jS F Y');
	}
}

if (!function_exists('formatDateTime')) {
	function formatDateTime($date)
	{
		return Carbon::parse($date)->format('jS M Y, h:i a');
	}
}

if (!function_exists('isBusinessPlanSubscribed')) {
	function isBusinessPlanSubscribed($otherUser = null)
	{
		$user = auth()->user();
		if($otherUser){
			$user = $otherUser;
		}
		return 
			$user->subscribed('business-annual-eur') || 
			$user->subscribed('business-annual-inr') ||
			$user->subscribed('business-annual-usd');
		// return $user->subscribed('business-plan-annually') || $user->subscribed('business-plan-quarterly') || $user->subscribed('business-plan-annually-inr') || $user->subscribed('business-plan-quarterly-inr');
	}
}

if (!function_exists('isEnterprisePlanSubscribed')) {
	function isEnterprisePlanSubscribed($otherUser = null)
	{
		$user = auth()->user();
		if($otherUser){
			$user = $otherUser;
		}
		return 
			$user->subscribed('essential-monthly-eur') || $user->subscribed('essential-annual-eur') ||
			$user->subscribed('essential-monthly-inr') || $user->subscribed('essential-annual-inr') || 
			$user->subscribed('essential-monthly-usd') || $user->subscribed('essential-annual-usd');
		// return $user->subscribed('enterprise-plan-annually') || $user->subscribed('enterprise-plan-quarterly') || $user->subscribed('enterprise-plan-annually-inr') || $user->subscribed('enterprise-plan-quarterly-inr');
	}
}

if (!function_exists('isSubscribed')) {
	function isSubscribed($otherUser = null)
	{
		$user = auth()->user();
		if($otherUser){
			$user = $otherUser;
		}
		return isArchitect() && ( isBusinessPlanSubscribed($user) || isEnterprisePlanSubscribed($user) );
	}
}
