<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'selectedChat' => 'required|exists:chats,id',
            'newMessage' => 'required',
        ];
    }

	public function messages(): array
	{
		return [
			'*.exists' => 'Select the valid :attribute.',
			'*.required' => 'Enter the :attribute.',
		];
	}

	public function attributes(): array
	{
		return [
			'selectedChat' => 'chat',
			'newMessage' => 'message',
		];
	}
}
