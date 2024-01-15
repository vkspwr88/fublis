<?php
namespace App\View\Composers;

use App\Http\Controllers\Users\SocialMediaController;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SocialMediaComposer
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
		$view->with('socialMedias', SocialMediaController::getAll());
	}
}
