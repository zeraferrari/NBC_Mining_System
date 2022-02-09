<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RhesusValidation extends FormRequest
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
            'Name' => 'required|unique:rhesus_categories',
        ];
    }

    public function messages()
    {
        return [
            'Name.required' => 'Mohon field inputan ini diisi !',
            'Name.unique'   => 'Nama tersebut sudah tersedia !',
        ];
    }
}
