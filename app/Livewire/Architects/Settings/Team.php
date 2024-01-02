<?php

namespace App\Livewire\Architects\Settings;

use App\Enums\Users\Architects\UserRoleEnum;
use Livewire\Component;

class Team extends Component
{
	public $architects;
	public $selectedArchitectId = '';
	public $selectedUserRole = '';
	public $isEditEnabled = false;
	public $userRoles;

	public function mount()
	{
		$this->architects = auth()->user()->architect->company->architects->load(['user', 'profileImage']);
		$this->userRoles = UserRoleEnum::cases();
		//dd($this->userRoles);
	}

    public function render()
    {
        return view('livewire.architects.settings.team');
    }

	public function editArchitect(string $architectId)
	{
		$this->selectedArchitectId = $architectId;
		$this->selectedUserRole = $this->architects->find($architectId)->user_role;
		$this->isEditEnabled = true;
	}

	public function cancelArchitect()
	{
		$this->selectedArchitectId = '';
		$this->isEditEnabled = false;
	}

	public function updateArchitect()
	{
		//dd($this->selectedUserRole, $this->selectedArchitectId);
		$architect = $this->architects->find($this->selectedArchitectId);
		$updated = $architect->update([
			'user_role' => $this->selectedUserRole,
		]);
		if($updated){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully updated the user role.'
			]);
		}
		$this->cancelArchitect();
	}


}
