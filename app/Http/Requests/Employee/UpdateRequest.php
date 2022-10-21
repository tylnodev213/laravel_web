<?php

namespace App\Http\Requests\Employee;

use App\Enums\Employee\GenderEnum;
use App\Enums\Employee\PositionEnum;
use App\Enums\Employee\StatusEnum;
use App\Enums\Employee\TypeOfWorkEnum;
use App\Models\Employee;
use App\Models\Team;
use Illuminate\Contracts\Validation\Validator;
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
            'team_id' => [
                'bail',
                'required',
                Rule::exists(Team ::class, 'id'),
            ],
            'first_name' => [
                'bail',
                'required',
                'max:128',
            ],
            'last_name' => [
                'bail',
                'required',
                'max:128',
            ],
            'email' => [
                'bail',
                'required',
                'email',
                'max:128',
                Rule::unique(Employee::class)->ignore($this->get('id')),
            ],
            'gender' => [
                'bail',
                'required',
                Rule::in(GenderEnum::asArray()),
            ],
            'birthday' => [
                'bail',
                'required',
                'date_format:m/d/Y',
                'before:now',
            ],
            'address' => [
                'bail',
                'required',
                'max:256',
            ],
            'old_avatar' => [
                'bail',
                'required',
            ],
            'avatar' => [
                'bail',
                'required_if:old_avatar,null',
                'image',
                'file_extension:jpeg,png,jpg,gif',
                'mimes:jpeg,png,jpg,gif',
                'mimetypes:image/jpeg,image/png,image/jpg,image/gif',
                'max:2048',
            ],
            'salary' => [
                'bail',
                'required',
                'numeric',
                'integer',
                'max:99999999999',
                'min:0'
            ],
            'position' => [
                'bail',
                'required',
                Rule::in(PositionEnum::asArray()),
            ],
            'type_of_work' => [
                'bail',
                'required',
                Rule::in(TypeOfWorkEnum::asArray()),
            ],
            'status' => [
                'bail',
                'required',
                Rule::in(StatusEnum::asArray()),
            ],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute '.config('constants.input_blank'),
            'team_id.exist' => ':attribute '.config('constants.not_exist_value'),
            'gender.required'   => ':attribute '.config('constants.radio_blank'),
            'position.required'   => ':attribute '.config('constants.select_blank'),
            'type_of_work.required'   => ':attribute '.config('constants.select_blank'),
            'status.required'   => ':attribute '.config('constants.radio_blank'),
            'avatar.required_if'   => ':attribute '.config('constants.file_upload_required'),
            'avatar.file_extension' => ':attribute '.config('constants.file_upload_extension'),
        ];
    }

    public function attributes(): array
    {
        return [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'team_id' => 'Team',
            'gender' => 'Gender',
            'birthday' => 'Birthday',
            'address' => 'Address',
            'salary' => 'Salary',
            'position' => 'Position',
            'type_of_work' => 'Type of work',
            'status' => 'Status',
            'avatar' => 'File upload',
        ];
    }

    protected function prepareForValidation()
    {
        $avatar = storeFile($this);

        if(empty($avatar)) {
            $avatar = $this->get('old_avatar');
        }else {
            removeFile($this->get('old_avatar'));
        }
        $this->merge([
            'id' => $this->route('employee'),
            'old_avatar' => $avatar,
            'email' => trim($this->get('email')),
            'first_name' => trim($this->get('first_name')),
            'last_name' => trim($this->get('last_name')),
            'address' => trim($this->get('address')),
            'birthday' => date('m/d/Y',strtotime($this->get('birthday'))),
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        // Merge the modified inputs to the global request.
        request()->merge($this->input());

        parent::failedValidation($validator);
    }
}
