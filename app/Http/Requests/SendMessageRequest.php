<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
{

    public function authorize()
    {
        return true; 
    }

 
    public function rules()
    {
        return [
            'message' => 'required|string|max:1000',
        ];
    }


    public function messages()
    {
        return [
            'message.required' => 'A message is required',
            'message.string' => 'The message must be text',
            'message.max' => 'The message cannot exceed 1000 characters',
        ];
    }
}