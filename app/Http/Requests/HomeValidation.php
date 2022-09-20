<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeValidation extends FormRequest
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
            'Age'               =>  'required',
            'Weight'            =>  'required',
            'Hemoglobin'        =>  'required',
            'Pressure_Sistole'  =>  'required',
            'Pressure_Diastole' =>  'required',
        ];
    }

    public function messages(){
        return [
            'Age.required'                        =>  'Mohon field ini diisi !',
            'Weight.required'                     =>  'Mohon field ini diisi !',
            'Hemoglobin.required'                 =>  'Mohon field ini diisi !',
            'Pressure_Sistole.required'           =>  'Mohon field ini diisi !',
            'Pressure_Diastole.required'          =>  'Mohon field ini diisi !',
        ];
    }
}
