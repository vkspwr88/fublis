<?php

namespace App\Livewire\Architects\Settings;

use App\Http\Controllers\Users\Architects\PositionController;
use App\Http\Controllers\Users\LocationController;
use App\Services\Architects\SettingService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule as ValidationRule;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class PersonalInfo extends Component
{
	use WithFileUploads;

	#[Rule('nullable|image|mimes:svg,png,jpg,gif|max:3100|dimensions:max_width=400,max_height=400')]
	public $profileImageOld;
	public $profileImage;
	public $name;
	public $email;
	public $company;
	public $position;
	public $location;
	public $aboutMe;

	private SettingService $settingService;

	public function mount()
	{
		$architect = auth()->user()->architect->load(['company', 'profileImage']);
		$this->name = auth()->user()->name;
		$this->email = auth()->user()->email;
		$this->company = $architect->company->name;
		$this->position = $architect->architect_position_id;
		$this->location = $architect->location_id;
		$this->aboutMe = $architect->about_me;
		$this->profileImageOld = $architect->profileImage;
	}

	public function boot()
	{
		$this->settingService = app()->make(SettingService::class);
	}

    public function render()
    {
        return view('livewire.architects.settings.personal-info', [
			'locations' => LocationController::getAll(),
			'positions' => PositionController::getAll(),
		]);
    }

	public function finishUpload($name, $tmpPath, $isMultiple)
    {
		$this->cleanupOldUploads();
		if ($isMultiple) {
            $file = collect($tmpPath)->map(function ($i) {
                return TemporaryUploadedFile::createFromLivewire($i);
            })->toArray();
            $this->emitSelf('upload:finished', $name, collect($file)->map->getFilename()->toArray());
        } else {
            $file = TemporaryUploadedFile::createFromLivewire($tmpPath[0]);
            $this->emitSelf('upload:finished', $name, [$file->getFilename()]);

            // If the property is an array, but the upload ISNT set to "multiple"
            // then APPEND the upload to the array, rather than replacing it.
            if (is_array($value = $this->getPropertyValue($name))) {
                $file = array_merge($value, [$file]);
            }
        }
        $this->syncInput($name, $file);
    }

	public function rules()
	{
		return [
			'name' => 'required',
			'email' => [
				'required',
				'email:rfc,dns',
				ValidationRule::unique('users')->ignore(auth()->id()),
			],
			'profileImage' => 'nullable|image|mimes:svg,png,jpg,gif|max:3100|dimensions:max_width=400,max_height=400',
			'position' => 'required',
			'location' => 'required',
			'aboutMe' => 'required|max:275',
		];
	}

	public function messages()
	{
		return [
			'name.required' => 'Enter the :attribute.',
			'email.required' => 'Enter the :attribute.',
			'email.email' => 'Enter valid :attribute.',
			'email.unique' => 'The :attribute is already registerred.',
			'profileImage.required' => 'Upload the :attribute.',
			'profileImage.image' => 'The :attribute supports only image.',
			'profileImage.mimes' => 'The :attribute supports only svg, png, jpg or gif.',
			'profileImage.max' => 'Maximum allowed size to upload :attribute 3MB.',
			'profileImage.dimensions' => 'Maximum allowed dimension for the :attribute is 400x400px.',
			'position.required' => 'Select the :attribute.',
			'location.required' => 'Select the :attribute.',
			'aboutMe.required' => 'Enter the :attribute.',
			'aboutMe.max' => 'The :attribute allows only 275 characters.',
		];
	}

	public function validationAttributes()
	{
		return [
			'name' => 'full name',
			'email' => 'amail address',
			'profileImage' => 'profile image',
			'position' => 'role',
			'location' => 'country',
			'aboutMe' => 'bio',
		];
	}

	public function update()
	{
		$validated = $this->validate($this->rules(), $this->messages(), $this->validationAttributes());
		if(!$this->profileImageOld && !$this->profileImage){
			$this->addError('profileImage', 'Upload profile image.');
			return;
		}
		//dd($validated);
		if($this->settingService->updatePersonalInfo($validated)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully updated the personal info.'
			]);
			return to_route('architect.account.profile.setting.personal-info');
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in updating the personal info. Please try again or contact support.'
		]);

	}
}
