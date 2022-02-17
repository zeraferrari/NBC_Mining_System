<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateValidation extends FormRequest
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
            'name' => ['required', 'regex:/^[\pL\s\-]+$/u' , 'min:3' ,'max:100'],
            'roles' => ['required'],
            'NIK' => ['required', 'numeric', 'digits:16', Rule::unique('users')->ignore($this->id, 'id')],
            'Gender' => ['required'],
            'phone_number' => ['required', 'numeric', 'digits_between:10,13'],
            'alamat' => ['required', 'string', 'max:100'],
            'profile_picture' => ['nullable','image', 'mimes:jpg,png,jpeg', 'min:256', 'max:6144'],
            'Rhesus_id' => ['nullable']
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Mohon field ini diisi !',
            'name.regex'        => 'Inputan hanya berupa huruf !',
            'name.min'          => 'Minimal 3 inputan huruf !',
            'name.max'          => 'Maksimal 100 inputan huruf !',
        //========================================================
            'roles.required'    => 'Field ini belum dipilih !',
        //Pesan kolom NIK
            'NIK.required'      =>  'Mohon field ini diisi !',
            'NIK.numeric'       =>  'Inputan hanya berupa angka !',
            'NIK.digits'        =>  'Inputan harus 16 digit !',
            'NIK.unique'        =>  'NIK telah terdaftar !',
        //========================================================
        // Pesan kolom gender
            'Gender.required'   =>  'Mohon field ini diisi !',
        //========================================================
        // Pesan Kolom Nomor Telepon
            'phone_number.required' => 'Mohon field ini diisi !',
            'phone_number.numeric'  => 'Inputan hanya berupa angka !',
            'phone_number.digits_between' => 'Inputan minimal :min digit maksimal :max digit !',
        //========================================================
        // Pesan Kolom Alamat
            'alamat.required'   =>  'Mohon field ini diisi !',
            'alamat.max'        =>  'Maksimal 100 inputan karakter !',
        // ========================================================
        'profile_picture.image'   => 'Field ini hanya boleh mengupload file photo !',
            'profile_picture.mimes'   => 'Extensi gambar hanya diperbolehkan jpg, png, jpeg !',
            'profile_picture.min'     => 'Minimal ukuran file sebesar 256 KB(KiloByte) !',
            'profile_picture.max'     => 'Maksimal ukuran file sebesar 6 MB(Mega Byte) !',
        ];
    }
}
