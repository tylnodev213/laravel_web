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
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:5',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email '.config('constants.input_blank'),

            'email.email' => 'Email '.config('constants.incorrect_format'),

            'password.required' => 'Password '.config('constants.input_blank'),

            'password.min' => 'Password '.config('constants.incorrect_min_length'),
        ];
    }
}
