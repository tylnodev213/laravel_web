<?php

namespace App\Http\Requests\Team;

use App\Models\Team;
use Illuminate\Foundation\Http\FormRequest;

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
            'course' => [
                'required',
                Rule::exists(Team ::class, 'id')
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['course' => $this->route('course')]);
    }
}
