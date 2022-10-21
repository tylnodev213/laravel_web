<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => [
                'bail',
                'required',
            ],
            'password' => [
                'bail',
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email '.config('constants.input_blank'),
            'password.required' => 'Password '.config('constants.input_blank'),
        ];
    }
}
