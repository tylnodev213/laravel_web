<?php

namespace App\Http\Requests\Employee;

use App\Models\Employee;
use App\Models\Team;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
                'required',
                Rule::exists(Team ::class, 'id'),
            ],
            'first_name' => [
                'required',
                'max:128',
            ],
            'last_name' => [
                'required',
                'max:128',
            ],
            'email' => [
                'bail',
                'required',
                'email',
                'max:128',
                Rule::unique(Employee::class)->ignore($this->email),
            ],
            'gender' => [
                'bail',
                'required',
                'max:1',
            ],
            'birthday' => [
                'bail',
                'required',
                'before:now',
            ],
            'address' => [
                'bail',
                'required',
                'max:256',
            ],
            'avatar' => [
                'bail',
                'required',
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
                'max:99999999999',
                'min:0',
            ],
            'position' => [
                'bail',
                'required',
                'max:1',
            ],
            'type_of_work' => [
                'bail',
                'required',
                'max:1',
            ],
            'status' => [
                'bail',
                'required',
                'max:1',
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
            'avatar.required'   => ':attribute '.config('constants.file_upload_required'),
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
            'old_avatar' => 'File upload',
        ];
    }

    protected function prepareForValidation()
    {
        $avatar = $this->get('avatar');

        $base64Image = explode(";base64,", $avatar);
        $explodeImage = explode("data:", $base64Image[0]);
        $mimetypes = $explodeImage[1]; // 1
        $mimes = explode("image/", $explodeImage[1]);
        $imageType = $mimes[1]; //2
        $avatar = [
            'mimetypes' => $mimetypes,
            'mines' => $imageType,
            'file_extension' => $imageType,
        ];

        $this->merge([
            'avatar' => $avatar,
        ]);
    }
}
