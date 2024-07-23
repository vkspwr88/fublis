<?php

namespace App\Livewire\Affiliates;

use App\Enums\Users\UserTypeEnum;
use App\Services\AffiliateService;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Registration extends Component
{

	#[Validate]
	public $name;
	#[Validate]
	public $email;
	#[Validate]
	public $publication_name;
	#[Validate]
	public $publication_url;
	#[Validate]
	public $how_will_you_promote_us;

    public function render()
    {
        return view('livewire.affiliates.registration');
    }

	public function rules()
	{
		return [
			'name' => ['required', 'max:255'],
			'email' => [
				'required',
				'max:255',
				'email',
				Rule::exists('users')->where(function (Builder $query) {
					return $query->where([
						'email' => $this->email,
						'user_type' => UserTypeEnum::JOURNALIST,
					]);
				}),
			],
			'publication_name' => ['required', 'max:255'],
			'publication_url' => ['required', 'max:255', 'url:https'],
			'how_will_you_promote_us' => ['required'],
		];
	}

	public function messages()
	{
		return [
			'*.required' => 'Enter the :attribute.',
			'*.url' => 'Enter the valid https :attribute.',
			'email.exists' => 'Journalist record does not exists.',
		];
	}

	public function validationAttributes()
	{
		return [
			'name' => 'name',
			'email' => 'email',
			'publication_name' => 'publication name',
			'publication_url' => 'publication url',
			'how_will_you_promote_us' => 'how will you promote us',
		];
	}

	public function data()
	{
		return [
			'name' => $this->name,
			'email' => $this->email,
			'publication_name' => $this->publication_name,
			'publication_url' => 'https://' . trimWebsiteUrl($this->publication_url),
			'how_will_you_promote_us' => $this->how_will_you_promote_us,
		];
	}

	public function submit()
	{
		// dd($this->all());
		$validated = Validator::make($this->data(), $this->rules(), $this->messages(), $this->validationAttributes())->validate();
		// dd($validated);
		$response = AffiliateService::register($validated);
		if($response['success']){
			$this->dispatch('show-registration-success-modal');
			$this->reset();
			return;
		}
		$this->dispatch('alert', [
			'type' => $response['type'],
			'message' => $response['message'],
		]);
	}
}
