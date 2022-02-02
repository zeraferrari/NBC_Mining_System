<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateValidation;
use App\Http\Requests\UserUpdateValidation;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function test(){
        return view('layouts.Main_Manajement');
    }

    public function index()
    {
        $data_user = User::with('roles')->get();
        $title = 'Manajement Dashboard User';
        return view('User.index', compact('data_user', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role_name = Role::all();
        return view('User.create', compact('role_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateValidation $request)
    {
        $data_has_validated = $request->validated();
        $data_has_validated['password'] = Hash::make($data_has_validated['password']);
        $user_data = User::create($data_has_validated);
        $user_data->assignRole($request->input('roles'));
        return redirect()->route('users.index')->with('success', 'User' .$user_data->name. 'Berhasil Dibuat');
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
    public function edit($id)
    {
        $user_data = User::find($id);
        $role_name = Role::all();
        $user_role = $user_data->roles()->first();
        $user_role = $user_role->name;
        return view('User.edit', compact('user_data', 'role_name', 'user_role'));
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
        $data_has_validated = $request->validated();
        $data_has_validated['password'] = Hash::make($data_has_validated['password']);
        $data = User::find($id);
        $data->update($data_has_validated);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $data->assignRole($request->input('roles'));
        return redirect()->route('users.index')->with('success', 'User dengan NIK : '.$data->NIK.' berhasil diupdate !');        
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
        $user_data->delete();
        return redirect()->route('users.index')->with('message', 'Data' .$user_data->name. 'telah berhasil dihapus !');
    }
}
