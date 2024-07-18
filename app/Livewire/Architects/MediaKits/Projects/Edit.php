<?php

namespace App\Livewire\Architects\MediaKits\Projects;

use App\Http\Controllers\Users\BuildingUseController;
use App\Http\Controllers\Users\LocationController;
use App\Livewire\Forms\Architects\ProjectForm;
use Hamcrest\Type\IsInteger;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

	public $mediaKitId;
	public ProjectForm $form;

	public function mount($mediaKit)
	{
		//dd(Storage::size($mediaKit->story->cover_image_path));
		$this->form->mount();
		$this->form->editMediaKit($mediaKit);
		$this->mediaKitId = $mediaKit->id;
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

	public function render()
    {
		// if(IsInteger($this->form->selectedCountry))
		$country = LocationController::getCountryByCountryName($this->form->selectedCountry);
		// dd($country, $this->form->selectedCountry);
		$this->form->states = collect([]);
		$this->form->cities = collect([]);
		if($country && $country->id){
			$this->form->states = LocationController::getStatesByCountryId($country->id);
			$this->form->cities = LocationController::getCitiesByStateId($this->form->selectedState);
		}
		// $this->form->states = LocationController::getStatesByCountryId($this->form->selectedCountry);
		// $this->form->cities = LocationController::getCitiesByStateId($this->form->selectedState);
		$category = $this->form->categories->find($this->form->category);
		if($category && ($category->name === 'Architecture' || $category->name === 'Interior Design')){
			$this->form->showOtherFields = true;
			$this->form->buildingUses = BuildingUseController::getAllByTypologyId($this->form->buildingTypology);
		}
		else{
			$this->form->showOtherFields = false;
			$this->form->buildingTypology = '';
		}

        return view('livewire.architects.media-kits.projects.edit');
    }

	public function add()
	{
		if($this->form->update($this->mediaKitId)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully updated project.'
			]);
			return to_route('architect.add-story.project.success');
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in updating project. Please try again or contact support.'
		]);
	}

	public function removeImage($childId)
	{
		$this->form->deleteImage($this->mediaKitId, $childId, 'edit');
	}

	public function preview()
	{
		$this->form->preview('edit', $this->mediaKitId);
	}
}
