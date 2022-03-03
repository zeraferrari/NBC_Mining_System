<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateValidation;
use App\Http\Requests\UserUpdateValidation;
use App\Models\RhesusCategory;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $title = 'Manajement Dashboard User';

    public function index()
    {
        $data = User::with('Rhesus_Connection')->get();
        $title = $this->title;
        return view('Manajement.Users.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_role = Role::all();
        $rhesus = RhesusCategory::all();
        $title = $this->title;
        return view('Manajement.Users.create', compact('data_role', 'rhesus', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateValidation $request)
    {
        $data_has_been_validated = $request->validated();
        $data_has_been_validated['Status_Donor'] = 'Belum Mendonor';
        if($request->hasFile('profile_picture')){
            $date = Carbon::now('Asia/Makassar')->format('dmYHi');
            $HashNameImage = $request->file('profile_picture')->hashName();
            $ImageName = $date."-".$HashNameImage;
            $path_name = $request->file('profile_picture')->storeAs('image-profiles', $ImageName);
            $data_has_been_validated['profile_picture'] = $path_name;
            $data_has_been_validated['password'] = Hash::make($request->input('password'));
            $user_data = User::create($data_has_been_validated);
            $user_data->assignRole($data_has_been_validated['roles']);
            return redirect()->route('Manajement.Users.index');
        }else{
            $data_has_been_validated['password'] = Hash::make($request->input('password'));
            $user_data = User::create($data_has_been_validated);
            $user_data->assignRole($data_has_been_validated['roles']);
            return redirect()->route('Manajement.Users.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user_data = $user;
        $rhesus_data = RhesusCategory::all();
        $roles_data = Role::all();
        $title = $this->title;
        return view('Manajement.Users.edit', compact('user_data', 'rhesus_data', 'roles_data', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateValidation $request, $id)
    {
        $data_has_been_validated = $request->validated();

        if($request->hasFile('profile_picture')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $date = Carbon::now('Asia/Makassar')->format('dmYHi');
            $HashNameImage = $request->file('profile_picture')->hashName();
            $ImageName = $date."-".$HashNameImage;
            $path_name = $request->file('profile_picture')->storeAs('image-profiles', $ImageName);
            $data_has_been_validated['profile_picture'] = $path_name;
        }

        $user = User::find($id);
        $user->update($data_has_been_validated);
        return redirect()->route('Manajement.Users.index');       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_data = User::findOrFail($id);
        if($user_data->profile_picture){
            Storage::delete($user_data->profile_picture);
        }
        $user_data->delete();
        return redirect()->route('Manajement.Users.index')->with('message', 'Data' .$user_data->name. 'telah berhasil dihapus !');
    }
}
