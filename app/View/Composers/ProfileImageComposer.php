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
			$authJournalist = auth()->user()->journalist->load(['profileImage']);
			if($authJournalist->profileImage){
				$profileImage = Storage::url($authJournalist->profileImage->image_path);
			}
			else{
				$profileImage = AvatarController::setProfileAvatar([
					'name' => auth()->user()->name,
					'width' => 40,
					'fontSize' => 20,
					'background' => $authJournalist->background_color,
					'foreground' => $authJournalist->foreground_color,
				]);
			}

		}
		elseif(isArchitect()){
			$authArchitect = auth()->user()->architect->load(['profileImage']);
			if($authArchitect->profileImage){
				$profileImage = Storage::url($authArchitect->profileImage->image_path);
			}
			else{
				$profileImage = AvatarController::setProfileAvatar([
					'name' => auth()->user()->name,
					'width' => 40,
					'fontSize' => 20,
					'background' => $authArchitect->background_color,
					'foreground' => $authArchitect->foreground_color,
				]);
			}

		}
        $view->with('profileImage', $profileImage);
    }
}
