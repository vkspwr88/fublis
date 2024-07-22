<?php

namespace App\Livewire\Architects\AddStories;

ini_set('max_execution_time', 300);
use App\Livewire\Forms\Architects\ArticleForm;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Article extends Component
{
    use WithFileUploads;

	public ArticleForm $form;

	public function render()
    {
        return view('livewire.architects.add-stories.article');
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
				'message' => 'You have successfully created article.'
			]);
			return to_route('architect.add-story.article.success');
		}
		$this->dispatch('alert', [
			'type' => 'warning',
			'message' => 'We are facing problem in creating article. Please try again or contact support.'
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
		return to_route('architect.add-story.article.index');
	}
}
