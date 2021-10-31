<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|alpha|min:3|max:100',
            'phone_number' => 'required|min:11|max:13|numeric',
            'alamat' => 'required',
            'Status_Donor' => 'nullable',
            'Gender' => 'required',
            'NIK' => 'required|numeric|min:16|unique:users',
            'profile_picture' => 'nullable',
            'Rhesus_id' => 'nullable',
            'email' => 'required|email|string|unique:users',
            'password' => 'required|alpha_num|min:6|confirmed'    
        ];
    }

    public function message(){
        return [
            'name' => [
                'required' => 'Field ini harap diisi !',
                'alpha' => 'Inputan hanya boleh berupa huruf !',
                'min' => 'Minimal :value karakter',
                'max' => 'Maksimal :value karakter'
            ],

            'phone_number' => [
                'required' => 'Field ini harap diisi !',
                'min' => 'Minimal :value angka',
                'max' => 'Maksimal :value angka',
                'numeric' => 'Inputan hanya boleh berupa angka !'
            ],

            'alamat' => [
                'required' => 'Field ini harap diisi !'
            ],

            'Gender' => [
                'required' => 'Field ini harap diisi !'
            ],

            'NIK' => [
                'required' => 'Field ini harap diisi !',
                'numeric' => 'Inputan hanya boleh berupa angka !',
                'min' => 'Inputan minimal :value angka',
                'unique' => 'NIK ini telah terdaftar'
            ],

            'email' => [
                'required' => 'Field ini harap diisi !',
                'email' => 'Inputkan alamat email anda !',
                'unique' => 'Email ini telah terdaftar'
            ],

            'password' => [
                'required' => 'Field ini harap disi !',
                'alpha_num' => 'Inputan kombinasi huruf dan angka !',
                'min' => 'Inputan minimal :value kombinasi huruf dan angka !',
                'confirmed' => 'Password tidak sesuai !',
            ],
        ];
    }
}
