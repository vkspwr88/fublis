<?php

namespace App\Livewire\Architects\AddStories;

ini_set('max_execution_time', 300);

use App\Http\Controllers\Users\Architects\MediaKitDraftController;
use App\Livewire\Forms\Architects\PressReleaseForm;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class PressReleaseDraft extends Component
{
	use WithFileUploads;

	public $draftId;
	public PressReleaseForm $form;

	public function mount($mediaKitDraft)
	{
		$this->form->mount();
		$this->form->fetchMediaKit($mediaKitDraft);
		$this->draftId = $mediaKitDraft->id;
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
        return view('livewire.architects.add-stories.press-release-draft');
    }

	public function add()
	{
		if($this->form->store()){
			MediaKitDraftController::deleteById($this->draftId);
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully created press release.'
			]);
			return to_route('architect.add-story.press-release.success');
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in creating press release. Please try again or contact support.'
		]);
	}

	public function preview()
	{
		$this->form->preview('update', $this->draftId);
	}

	public function draft()
	{
		$this->form->draft('update', $this->draftId);
		$this->dispatch('alert', [
			'type' => 'success',
			'message' => 'Your media kit is drafted successfully.'
		]);
	}

	public function removeImage($index)
	{
		$this->form->deleteImage($this->draftId, $index, 'draft');
	}

	public function deleteMediaKit()
	{
		MediaKitDraftController::deleteById($this->draftId);
		$this->dispatch('alert', [
			'type' => 'success',
			'message' => 'Your media kit is deleted successfully.'
		]);
		return $this->form->deleteMediaKit();
	}
}
