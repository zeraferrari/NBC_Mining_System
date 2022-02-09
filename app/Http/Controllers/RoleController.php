<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleValidation;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = Role::with('permissions')->get();
        $title = 'Manajement Dashboard Role';
        return view('Manajement.Roles.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_permission = Permission::all();
        $title = 'Manajement Dashboard Role';
        return view('Manajement.Roles.create', compact('data_permission', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleValidation $request)
    {
        $has_been_validated = $request->validated();
        Alert::success('Data Berhasil Dibuat !', 'Data role '.$has_been_validated['name']. ' berhasil ditambahkan')->showConfirmButton('confirm', '#3085d6');
        $role = Role::create($has_been_validated);
        $role->syncPermissions($has_been_validated['permission']);
        return redirect()->route('Manajement.Roles.index');
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
        $data_roles = Role::with('permissions')->find($id);
        $data_permissions = Permission::all();
        $title = 'Manajement Dashboard Role';
        $permissions_each_role = DB::table('role_has_permissions')
                    ->where('role_has_permissions.role_id', '=', $id)
                    ->pluck('permission_id')->all();
        
        return view('Manajement.Roles.edit', compact('data_roles', 'data_permissions', 'permissions_each_role', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleValidation $request, $id)
    {
        $has_been_validated = $request->validated();
        $role = Role::find($id);
        $role->update($has_been_validated);
        $role->syncPermissions($has_been_validated['permission']); 
        return redirect()->route('Manajement.Roles.index')->with('success', 'Role ' .$role->name. ' Has Been Update !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role_test = $role->name;
        $role->delete();
        return redirect()->route('Manajement.Roles.index')->with('success', 'Role ' .$role_test. ' Has Been Delete !' );
    }
}
