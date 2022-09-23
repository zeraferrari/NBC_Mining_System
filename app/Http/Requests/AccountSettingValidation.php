<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountSettingValidation extends FormRequest
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
            'Gender'        =>  ['required'],
            'phone_number'  =>  ['required', 'numeric', 'digits_between:10,13', Rule::unique('users', 'phone_number')->ignore($this->user()->id, 'id')],
            'profile_picture'   =>  ['nullable','image', 'mimes:jpg,png,jpeg', 'min:256', 'max:6144'],
            'alamat'        =>  ['required'],
        ];
    }

    public function messages(){
        return [
            'Gender.required'           =>  'Mohon field ini diisi !',

            'phone_number.required'     =>  'Mohon field ini diisi !',
            'phone_number.numeric'      =>  'Field ini hanya boleh angka !',
            'phone_number.digits_between'   =>  'Inputan minimal :min digit maksimal :max digit !',
            'phone_number.unique'       =>  'Nomor handphone ini telah teregistrasi, silahkan pakai nomor yang berbeda !',

            'profile_picture.image'           =>    'Field ini hanya boleh mengupload file photo',
            'profile_picture.mimes'           =>    'Format hanya diperbolehkan: jpg, png, jpeg',
            'profile_picture.min'             =>    'minimal ukuran size file 256KB (Kilobyte)',
            'profile_picture.max'             =>    'maksimal ukuran size file 6MB (MegaByte)',
            
            'alamat.required'           =>  'Mohon field ini diisi !',
        ];
    }
}
