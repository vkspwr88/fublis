<?php
namespace App\View\Composers;

use App\Http\Controllers\Users\AvatarController;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileImageComposer
{
    /**
     * Create a new profile composer.
     */
    public function __construct() {}

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
		$profileImage = 'https://via.placeholder.com/40x40';
		if(isJournalist()){
			$authJournalist = auth()->user()->journalist;
			$profileImage = AvatarController::getProfileAvatar($authJournalist, 'journalist');
			/* if($authJournalist->profileImage){
				$profileImage = Storage::url($authJournalist->profileImage->image_path);
			}
			else{
				$profileImage = AvatarController::getProfileAvatar($authJournalist, 'journalist');
			} */
		}
		elseif(isArchitect()){
			$authArchitect = auth()->user()->architect;
			$profileImage = AvatarController::getProfileAvatar($authArchitect, 'architect');
			/* if($authArchitect->profileImage){
				$profileImage = Storage::url($authArchitect->profileImage->image_path);
			}
			else{
				$profileImage = AvatarController::getProfileAvatar($authArchitect, 'architect');
			} */
		}
        $view->with('profileImage', $profileImage);
    }
}
