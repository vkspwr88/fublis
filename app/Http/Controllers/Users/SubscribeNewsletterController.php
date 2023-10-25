<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Interfaces\SubscribeNewsletterRepositoryInterface;
use App\Mail\Subscription\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscribeNewsletterController extends Controller
{
    private SubscribeNewsletterRepositoryInterface $subscribeNewsletterRepository;

    public function __construct(SubscribeNewsletterRepositoryInterface $subscribeNewsletterRepository)
    {
        $this->subscribeNewsletterRepository = $subscribeNewsletterRepository;
    }

    public function verify(string $token)
    {
		$verify = $this->subscribeNewsletterRepository->verifySubscriber($token);
		if($verify){
			$subscriber = $this->subscribeNewsletterRepository->getSubscriberByToken($token);
			Mail::to($subscriber->email)->queue(new WelcomeMail($subscriber));
		}
        return view('users.pages.subscribe-newsletter.verify', [
            'verify' => $verify,
		]);
    }
}
