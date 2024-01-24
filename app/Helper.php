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
		return isArchitect() && auth()->user()->architect->user_role === UserRoleEnum::ADMIN;
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
		return str()->remove('http://', $url);
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
