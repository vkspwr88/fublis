<?php

namespace App\Livewire\Architects\AddStories;

ini_set('max_execution_time', 300);
use App\Http\Controllers\Users\BuildingUseController;
use App\Http\Controllers\Users\LocationController;
use App\Livewire\Forms\Architects\ProjectForm;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Project extends Component
{
    use WithFileUploads;

	public ProjectForm $form;

	public function render()
    {
		$country = LocationController::getCountryByCountryName($this->form->selectedCountry);
		// dd($country);
		if($country && $country->id){
			$this->form->states = LocationController::getStatesByCountryId($country->id);
			$this->form->cities = LocationController::getCitiesByStateId($this->form->selectedState);
		}

		$category = $this->form->categories->find($this->form->category);
		if($category && ($category->name === 'Architecture' || $category->name === 'Interior Design')){
			$this->form->showOtherFields = true;
			$this->form->buildingUses = BuildingUseController::getAllByTypologyId($this->form->buildingTypology);
		}
		else{
			$this->form->showOtherFields = false;
			$this->form->buildingTypology = '';
		}

		return view('livewire.architects.add-stories.project');
    }

	public function mount()
	{
		$this->form->mount();
		$this->characterCount();
	}

	public function characterCount()
	{
		$this->form->characterCount();
	}

	public function _finishUpload($name, $tmpPath, $isMultiple)
    {
        $this->cleanupOldUploads();

        if ($isMultiple) {
            $file = collect($tmpPath)->map(function ($i) {
                return TemporaryUploadedFile::createFromLivewire($i);
            })->toArray();
            $this->dispatch('upload:finished', name: $name, tmpFilenames: collect($file)->map->getFilename()->toArray())->self();
            if (is_array($value = $this->getPropertyValue($name))) {
                $file = array_merge($value, $file);
            }
        } else {
            $file = TemporaryUploadedFile::createFromLivewire($tmpPath[0]);
            $this->dispatch('upload:finished', name: $name, tmpFilenames: [$file->getFilename()])->self();

            // If the property is an array, but the upload ISNT set to "multiple"
            // then APPEND the upload to the array, rather than replacing it.
            if (is_array($value = $this->getPropertyValue($name))) {
                $file = array_merge($value, [$file]);
            }
        }

        app('livewire')->updateProperty($this, $name, $file);
    }

	public function add()
	{
		if($this->form->store()){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully created project.'
			]);
			return to_route('architect.add-story.project.success');
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in creating project. Please try again or contact support.'
		]);
	}

	public function preview()
	{
		$this->form->preview('create');
	}

	public function draft()
	{
		$this->form->draft('create');
		$this->dispatch('alert', [
			'type' => 'success',
			'message' => 'Your media kit is drafted successfully.'
		]);
	}

	public function deleteMediaKit()
	{
		$this->dispatch('alert', [
			'type' => 'success',
			'message' => 'Your media kit is deleted successfully.'
		]);
		return to_route('architect.add-story.project.index');
	}
}
