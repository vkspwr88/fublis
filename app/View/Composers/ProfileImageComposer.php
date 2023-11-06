<?php
namespace App\View\Composers;

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

		}
		elseif(isArchitect()){
			$authArchitect = auth()->user()->architect->load(['profileImage']);
			if($authArchitect->profileImage){
				$profileImage = Storage::url($authArchitect->profileImage->image_path);
			}

		}
        $view->with('profileImage', $profileImage);
    }
}
