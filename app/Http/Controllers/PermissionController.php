<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionValidation;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    private $title = 'Manajement Dashboard Hak Akses';


    public function index()
    {
        $data = Permission::all();
        $title = $this->title;
        return view('Manajement.Permissions.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = $this->title;
        return view('Manajement.Permissions.create', compact('title'));
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
        Alert::success('Data Berhasil Dibuat !', 'Data dengan nama '.$has_been_validate['name'].' telah berhasil dibuat !');
        return redirect()->route('Manajement.Permissions.index')->with('success', 'Hak Akses Berhasil Dibuat !');
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
        $title = $this->title;
        return view('Manajement.Permissions.edit', compact('data', 'title'));
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
        return redirect()->route('Manajement.Permissions.index')->with('success', 'Hak Akses Berhasil DiPerbaharui !');
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
        return redirect()->route('Manajement.Permissions.index')->with('success', 'Data Telah Berhasil Dihapus !');
    }
}
