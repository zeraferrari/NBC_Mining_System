<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionValidation extends FormRequest
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
            'name' => ['required', 'regex:/^[\pL\s\-]+$/u'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Mohon field ini diisi !',
            'name.alpha'    =>  'Field ini hanya boleh inputan huruf !'
        ];
    }
}
