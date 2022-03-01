<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionUpdateValidation extends FormRequest
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
            'Age'   =>  ['required', 'numeric', 'min:0'],
            'Weight'    =>  ['required', 'numeric', 'min:0'],
            'Hemoglobin'    =>  ['required', 'numeric', 'min:0'],
            'Pressure_sistole'  =>  ['required', 'numeric', 'min:0'],
            'Pressure_diastole' =>  ['required', 'numeric', 'min:0'],
            'Rhesus_Categories'         => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'Age.required'          =>  'Mohon field ini diisi !',
            'Age.numeric'           =>  'Field ini hanya menerima inputan angka !',
            'Age.min'               =>  'Minimal inputan nilai = :min',

            'Weight.required'          =>  'Mohon field ini diisi !',
            'Weight.numeric'           =>  'Field ini hanya menerima inputan angka !',
            'Weight.min'               =>  'Minimal inputan nilai = :min',

            'Hemoglobin.required'          =>  'Mohon field ini diisi !',
            'Hemoglobin.numeric'           =>  'Field ini hanya menerima inputan angka !',
            'Hemoglobin.min'               =>  'Minimal inputan nilai = :min',

            'Pressure_sistole.required'          =>  'Mohon field ini diisi !',
            'Pressure_sistole.numeric'           =>  'Field ini hanya menerima inputan angka !',
            'Pressure_sistole.min'               =>  'Minimal inputan nilai = :min',

            'Pressure_diastole.required'          =>  'Mohon field ini diisi !',
            'Pressure_diastole.numeric'           =>  'Field ini hanya menerima inputan angka !',
            'Pressure_diastole.min'               =>  'Minimal inputan nilai = :min',

            'Rhesus_Categories.required'           =>   'Mohon field ini diisi !',
        ];
    }
}
