<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionValidation;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Permission::all();
        $title = 'Manajement Dashboard Hak Akses';
        return view('Permission.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionValidation $request)
    {
        $has_been_validate = $request->validated();
        Permission::create($has_been_validate);
        return redirect()->route('permission.index')->with('success', 'Hak Akses Berhasil Dibuat !');
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
        $data = Permission::find($id);
        return view('Permission.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionValidation $request, $id)
    {
        $has_been_validate = $request->validated();
        $permission = Permission::find($id);
        $permission->update($has_been_validate);
        return redirect()->route('permission.index')->with('success', 'Hak Akses Berhasil DiPerbaharui !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Permission::findOrFail($id)->delete();
        return redirect()->route('permission.index')->with('success', 'Data Telah Berhasil Dihapus !');
    }
}
