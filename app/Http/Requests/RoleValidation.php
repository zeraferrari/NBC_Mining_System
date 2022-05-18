<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name'  => ['required', 'regex:/^[\pL\s\-]+$/u', Rule::unique('roles')->ignore($this->id, 'id')],
            'permission' => ['required'],
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'Mohon Field Ini Diisi !',
            'name.regex'    => 'Field ini hanya boleh inputan huruf !',
            'name.unique'   => 'Role ini telah tersedia ! Silahkan buat yang berbeda',
            'permission.required' => 'Silahkan Hak Akses Diisi !',
        ];
    }
}
