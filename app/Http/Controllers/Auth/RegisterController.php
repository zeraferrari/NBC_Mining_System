<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/login';

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request){
        $this->validator($request->all())->validate();
        $this->create($request->all());
        return redirect()->route('login')->with('response_login', 'Data berhasil diregistrasi'); 
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        /* Validasi User Registrasi */
        return Validator::make($data, [
            'name' => ['required', 'regex:/^[\pL\s\-]+$/u' , 'min:3' ,'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'NIK' => ['required', 'numeric', 'digits:16', 'unique:users'],
            'Gender' => ['required'],
            'phone_number' => ['required', 'numeric', 'digits_between:10,13', 'unique:users,phone_number'],
            'alamat' => ['required', 'string', 'max:100'],
            'profile_picture' => ['image','mimes:jpg,png,jpeg', 'min:256', 'max:6144'],
            'Rhesus_id' => ['nullable'],
        ],

        /* Pesan custom diparsing ke-view jika 
        validasi false atau tidak sesuai validasi */
        [

        // Pesan kolom nama
            'name.required'     => 'Mohon field ini diisi !',
            'name.regex'        => 'Inputan hanya berupa huruf !',
            'name.min'          => 'Minimal 3 inputan huruf !',
            'name.max'          => 'Maksimal 100 inputan huruf !',
        //========================================================
        // Pesan kolom email
            'email.required'    =>  'Mohon field ini diisi !',
            'email.email'       =>  'Mohon email anda diinputkan !',
            'email.max'         =>  'Maksimal 100 karakter inputan !',
            'email.unique'      =>  'Email ini telah terdaftar !',
        //========================================================
        // Pesan kolom password
            'password.required' =>  'Mohon field ini diisi !',
            'password.min'      =>  'Minimal 6 Inputan',
        //========================================================
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
            'phone_number.unique'   =>  'Nomor handphone ini telah teregistrasi, silahkan pakai nomor yang berbeda !',
        //========================================================
        // Pesan Kolom Alamat
            'alamat.required'   =>  'Mohon field ini diisi !',
            'alamat.max'        =>  'Maksimal 100 inputan karakter !',
        // ========================================================
            'profile_picture.image'   => 'Field ini hanya boleh mengupload file photo !',
            'profile_picture.mimes'   => 'Extensi gambar hanya diperbolehkan jpg, png, jpeg !',
            'profile_picture.min'     => 'Minimal ukuran file sebesar 256 KB(KiloByte) !',
            'profile_picture.max'     => 'Maksimal ukuran file sebesar 6 MB(Mega Byte) !',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if(request()->hasFile('profile_picture')){
            $date = Carbon::now('Asia/Makassar')->format('dmYHi');
            $HashNameImage = request()->file('profile_picture')->hashName();
            $ImageName = $date."-".$HashNameImage;
            $path_name = request()->file('profile_picture')->storeAs('image-profiles', $ImageName);
            $data['profile_picture'] = $path_name;

            $data_user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'NIK'       => $data['NIK'],
                'Gender'    => $data['Gender'],
                'phone_number' => $data['phone_number'],
                'profile_picture'   =>  $data['profile_picture'],
                'alamat'    => $data['alamat'],
                'Status_Donor' => 'Belum Mendonor',
            ]);
        } else{
            $data_user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'NIK'       => $data['NIK'],
                'Gender'    => $data['Gender'],
                'phone_number' => $data['phone_number'],
                'alamat'    => $data['alamat'],
                'Status_Donor' => 'Belum Mendonor',
            ]);
        }

        
        $data_user->assignRole('Pendonor');
        return $data_user;
    }
}
