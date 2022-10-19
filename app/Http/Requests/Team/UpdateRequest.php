<?php

namespace App\Http\Requests\Team;

use App\Models\Team;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
                'bail',
                'required',
                Rule::exists(Team ::class, 'id'),
            ],
            'name' => [
                'bail',
                'required',
                Rule::unique(Team::class)->ignore($this->get('id')),
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute '.config('constants.input_blank'),
            'unique'   => ':attribute '.config('constants.duplicate_value'),
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Name',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('team'),
        ]);
    }
}
