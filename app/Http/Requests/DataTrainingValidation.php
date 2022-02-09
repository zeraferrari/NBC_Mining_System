<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataTrainingValidation extends FormRequest
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
            'Name'  =>  ['required', 'regex:/^[\pL\s\-]+$/u'],
            'Rhesus_id' => ['required'],
            'Gender'    => ['required', 'in:Laki-laki,Perempuan'],
            'Hemoglobin'   => ['required', 'numeric', 'min:1'],
            'Pressure_Sistole' => ['required', 'integer', 'min:1'],
            'Pressure_diastole' => ['required', 'integer', 'min:1'],
            'Weight'    =>  ['required', 'integer', 'min:1'],
            'Age'   =>  ['required', 'integer', 'min:1'],
            'Status'    =>  ['required', 'in:Layak,Tidak Layak']
        ];
    }

    public function messages()
    {
        return [
            'Name.required' => 'Mohon field ini diisi !',
            'Name.regex'    => 'Field ini hanya boleh huruf !',

            'Rhesus_id.required' => 'Mohon field ini diisi !',

            'Gender.required'   => 'Mohon field ini diisi !',
            'Gender.in'     =>  'Error ! Isi field dengan benar !',

            'Hemoglobin.required'   =>  'Mohon field ini disi !',
            'Hemoglobin.numeric'    => 'Field ini hanya menerima inputan angka !',
            'Hemoglobin.min'        => 'Inputan minimal bernilai 1 !',

            'Pressure_Sistole.required' => 'Mohon field ini diisi !',
            'Pressure_Sistole.integer'  => 'Field ini hanya menerima inputan angka !',
            'Pressure.Sistole.min'  =>  'Inputan minimal bernilai 1 !',

            'Pressure_diastole.required'    =>  'Mohon field ini diisi !',
            'Pressure_diastole.integer'     =>  'Field ini hanya menerima inputan angka !',
            'Pressure_diastole.min'         =>  'Inputan minimal bernilai 1 !',

            'Weight.required'       =>  'Mohon field ini diisi !',
            'Weight.integer'        =>  'Field ini hanya menerima inputan angka !',
            'Weight.min'            =>  'Inputan minimal bernilai 1 !',

            'Age.required'          =>  'Mohon field ini diisi !',
            'Age.integer'           =>  'Field ini hanya menerima inputan angka !',
            'Age.min'               =>  'Inputan minimal bernilai 1 !',

            'Status.required'       =>  'Mohon field ini diisi !',
            'Status.in'             =>  'Error ! Isi field dengan benar !'
        ];
    }
}
