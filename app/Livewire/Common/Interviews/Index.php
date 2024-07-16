<?php

namespace App\Livewire\Common\Interviews;

use App\Http\Controllers\ErrorLogController;
use App\Http\Controllers\Users\FileController;
use App\Http\Controllers\Users\ImageController;
use App\Models\Interview;
use App\Models\InterviewQuestion;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

	public Interview $interview;

	public $brief;
	public $projectBrief = [];
	public $oldProjectBrief = [];
	public $answers = [];
	public $profile_pic_path;

	public function mount($interview)
	{
		$this->interview = $interview;
		$this->brief = $interview->brief;
		$this->profile_pic_path = $interview->profile_pic_path;
		$this->oldProjectBrief = $interview->projectBrief->pluck('image_path');
		$this->answers = $interview->interviewQuestions->mapWithKeys(function($interviewQuestions){
			return [$interviewQuestions->id => $interviewQuestions->answer];
		});
		// dd($this->answers);
		// $this->answers = $interview->interviewQuestions->pluck('answer');
		/* $this->interview->load([
			'interviewQuestions',
			'projectBrief'
		]); */
	}

    public function render()
    {
        return view('livewire.common.interviews.index');
    }

	public function rules()
	{
		return [
			'answers' => 'nullable|array',
			'answers.*' => 'nullable|string',
			'profile_pic_path' => $this->getValidationRule('profile_pic_path'),
			'brief' => 'nullable|string',
			'projectBrief' => 'nullable|array',
			'projectBrief.*' => Rule::forEach(function (string|null $value, string $attribute) {
				return Str::contains($value, 'tmp') ?
							'nullable|file|' . __('validations/rules.zipPlusFileMimes') . '|' . __('validations/rules.bulkFilesSize') :
							'nullable|string';
			}),
		];
	}

	/* public function messages()
	{
		return [
			'answers.*.required' => 'Please answer the question #:index.',
		];
	} */

	public function getValidationRule(String $key): string
    {
		if ($key == 'profile_pic_path') {
			if($this->profile_pic_path instanceof TemporaryUploadedFile){
				return __('validations/rules.profileImage') . '|' . __('validations/rules.imageMimes');
			}
			else{
				return 'nullable|string';
			}
		}
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

	public function save($type)
	{
		$validated = $this->validate();
		// dd($validated, $this->all());
		try{
            DB::beginTransaction();

			$this->interview->update([
				'profile_pic_path' => $validated['profile_pic_path'] ? FileController::upload($validated['profile_pic_path'], 'images/interviews/profile-images', 'interview_save_'.$type) : null,
				'brief' => $validated['brief'],
			]);

			// update answers
			foreach($this->answers as $id => $answer){
				InterviewQuestion::where('id', $id)->update([
					'answer' => $answer,
				]);
			}

			// create briefs
			if(count($validated['projectBrief']) > 0){
				foreach($validated['projectBrief'] as $image){
					ImageController::create($this->interview->projectBrief(), [
						'image_type' => 'brief',
						'image_path' => FileController::upload($image, 'images/interviews/briefs', 'interview_save_'.$type),
					]);
				}
			}
            DB::commit();
		}
		catch(Exception $exp){
			DB::rollBack();
			ErrorLogController::logError(
				'save interview ' . $type, [
					'line' => $exp->getLine(),
					'file' => $exp->getFile(),
					'message' => $exp->getMessage(),
					'code' => $exp->getCode(),
				]
			);
			return $this->dispatch('alert', [
				'type' => 'warning',
				'message' => 'We are facing problem in submitting interview. Please try again or contact support.'
			]);
		}
		if($type == 'submit'){
			$this->dispatch('show-submit-interview-modal');
		}
		elseif($type == 'draft'){
			$this->dispatch('alert', [
				'type' => 'success',
				'message' => 'You have successfully saved the interview in draft.'
			]);
			$this->redirectUser();
		}
	}

	public function draft()
	{
		$this->save('draft');
	}

	public function submit()
	{
		// dd($this->interview->interviewQuestions->groupBy('id'), $this->answers);
		$this->save('submit');
	}

	public function finalSubmit()
	{
		$this->interview->update([
			'final_submission' => true,
			'submission_date' => Carbon::now(),
		]);
		$this->redirectUser();
	}

	public function redirectUser()
	{
		/* if(isArchitect()){
			return to_route('architect.interview.index', [
				'interview' => $this->interview->slug,
			]);
		}
		elseif(isJournalist()){
			return to_route('journalist.interview.index', [
				'interview' => $this->interview->slug,
			]);
		} */
		return to_route('interview.index', ['interview' => $this->interview->slug]);
	}

	public function cancelSubmit()
	{
		$this->dispatch('hide-submit-interview-modal');
	}

	public function removeImage($index)
	{
		$image = $this->interview->projectBrief->where('image_path', $this->oldProjectBrief[$index])->first();
		if($image){
			$image->delete();
		}
		Arr::pull($this->oldProjectBrief, $index);
	}
}
