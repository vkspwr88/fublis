<?php

namespace App\Livewire\Users\Blogs\Index;

use App\Interfaces\SubscribeNewsletterRepositoryInterface;
use App\Mail\Subscription\VerificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class SubscribeNewsletter extends Component
{
	#[Rule([
		'email' => 'required|email',
	], message: [
		'required' => 'The :attribute is missing',
		'email' => 'The :attribute is invalid',
	], attribute: [
		'email' => 'email address',
	])]
	public string $email;

	private SubscribeNewsletterRepositoryInterface $subscribeNewsletterRepository;

    public function render()
    {
        return view('livewire.users.blogs.index.subscribe-newsletter');
    }

	public function boot(){
		$this->subscribeNewsletterRepository = app()->make(SubscribeNewsletterRepositoryInterface::class);
	}

	#[On('subscribe-newsletter')]
	public function subscribeNewsletter($email){
		if($this->subscribeNewsletterRepository->isEmailVerified($email)){
			$this->addError('email', 'The email address is already subscribed');
			return;
		}

		if($this->subscribeNewsletterRepository->checkEmailSent($email)){
			$this->addError('email', 'Email is already send to your email address');
			return;
		}

		$details = [
			'email' => $email,
			'token' => sha1($email),
		];
		$subscriber = $this->subscribeNewsletterRepository->createSubscriber($details);

		Mail::to($this->email)->send(new VerificationMail($subscriber));

		$this->dispatch('alert', [
			'type' => 'success',
			'message' => 'Please check and verify your email address'
		]);
	}

	public function subscribe(){
		$this->validate();
		$this->subscribeNewsletter($this->email);
	}
}
