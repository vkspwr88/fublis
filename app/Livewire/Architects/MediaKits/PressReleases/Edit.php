<?php

namespace App\Livewire\Architects\MediaKits\PressReleases;

ini_set('max_execution_time', 300);

use App\Http\Controllers\Users\CategoryController;
use App\Livewire\Forms\Architects\PressReleaseForm;
use App\Services\AddStoryService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Edit extends Component
{
	use WithFileUploads;

	public $mediaKitId;
	public PressReleaseForm $form;

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
        return view('livewire.architects.media-kits.press-releases.edit');
    }

	public function add()
	{
		if($this->form->update($this->mediaKitId)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully updated press release.'
			]);
			return to_route('architect.add-story.press-release.success');
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in updating press release. Please try again or contact support.'
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

	public function deleteMediaKit()
	{
		if(AddStoryService::deleteMediaKit($this->mediaKitId)){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'Your media kit is deleted successfully.'
			]);
			return to_route('architect.media-kit.index');
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in deleting your media kit. Please try again or contact support.'
		]);
	}
}
