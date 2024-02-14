<?php

namespace App\Livewire\Architects\AddStories;

ini_set('max_execution_time', 300);

use App\Livewire\Forms\Architects\PressReleaseForm;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class PressRelease extends Component
{
    use WithFileUploads;
	
	public PressReleaseForm $form;

    public function render()
    {
        return view('livewire.architects.add-stories.press-release');
    }

	public function mount()
	{
		$this->form->mount();
		$this->characterCount();
		// $this->form->collectionName = 'photographsFiles';
        // $this->form->photographsFiles = $this->collection;
	}

	public function characterCount()
	{
		$this->form->characterCount();
	}

	public function finishUpload($name, $tmpPath, $isMultiple)
    {
		/* $this->cleanupOldUploads();
		dd($name, $tmpPath, $isMultiple);
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
        $this->syncInput($name, $file); */
		dd($name, $tmpPath, $isMultiple);

		$this->cleanupOldUploads();
        $files = collect($tmpPath)->map(function ($i) {
            return TemporaryUploadedFile::createFromLivewire($i);
        })->toArray();
        $this->emitSelf('upload:finished', $name, collect($files)->map->getFilename()->toArray());
        $files = array_merge($this->getPropertyValue($name), $files);
        $this->syncInput($name, $files);
    }

	public function add()
	{
		if($this->form->store()){
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
}
