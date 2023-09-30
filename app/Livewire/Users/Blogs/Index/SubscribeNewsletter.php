<?php

namespace App\Livewire\Users\Blogs\Index;

use App\Interfaces\SubscribeNewsletterRepositoryInterface;
use App\Mail\VerifySubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

	private SubscribeNewsletterRepositoryInterface $subscribeNewsletter;

    public function render()
    {
        return view('livewire.users.blogs.index.subscribe-newsletter');
    }

	public function boot(){
		$this->subscribeNewsletter = app()->make(SubscribeNewsletterRepositoryInterface::class);
	}

	public function subscribe(Request $request){
		$this->validate();

		//return (new VerifySubscriber())->render();

		Mail::to($this->email)->send(new VerifySubscriber());
	}
}
