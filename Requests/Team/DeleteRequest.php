<?php

namespace App\Http\Requests\Team;

use App\Models\Team;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteRequest extends FormRequest
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
            'id' => [
                'required',
                Rule::exists(Team ::class, 'id'),
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute '.config('constants.input_blank'),
            'exists'   => ':attribute '.config('constants.not_exist_value'),
        ];
    }

    public function attributes(): array
    {
        return [
            'id' => "Team's id",
        ];
    }
}
