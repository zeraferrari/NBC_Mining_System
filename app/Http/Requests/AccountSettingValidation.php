<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'phone_number'  =>  ['required', 'numeric'],
            'profile_picture'   =>  ['nullable','image', 'mimes:jpg,png,jpeg', 'min:256', 'max:6144'],
            'alamat'        =>  ['required']
        ];
    }

    public function messages(){
        return [
            'Gender.required'           =>  'Mohon field ini diisi !',

            'phone_number.required'     =>  'Mohon field ini diisi !',
            'phone_number.numeric'      =>  'Field ini hanya boleh angka !',

            'profile_picture.image'           =>    'Field ini hanya boleh mengupload file photo',
            'profile_picture.mimes'           =>    'Format hanya diperbolehkan: jpg, png, jpeg',
            'profile_picture.min'             =>    'minimal ukuran size file 256KB (Kilobyte)',
            'profile_picture.max'             =>    'maksimal ukuran size file 6MB (MegaByte)',
            
            'alamat.required'           =>  'Mohon field ini diisi !',
        ];
    }
}
