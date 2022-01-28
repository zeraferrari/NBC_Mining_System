<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleValidation extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => ['required', 'regex:/^[\pL\s\-]+$/u'],
            'permission' => ['required'],
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'Mohon Field Ini Diisi !',
            'name.regex'    => 'Field ini hanya boleh inputan huruf !',
            'permission.required' => 'Silahkan Hak Akses Diisi !',
        ];
    }
}
