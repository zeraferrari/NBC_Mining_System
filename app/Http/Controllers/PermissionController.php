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
        $Navigator = new HomeController;
        $latest_inbox = $Navigator->GetLatestInbox();
        $latest_notification = $Navigator->GetLatestNotification();
        return view('Manajement.Permissions.index', compact('data', 'title', 'latest_inbox', 'latest_notification'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = $this->title;
        $Navigator = new HomeController;
        $latest_inbox = $Navigator->GetLatestInbox();
        $latest_notification = $Navigator->GetLatestNotification();
        return view('Manajement.Permissions.create', compact('title', 'latest_inbox', 'latest_notification'));
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
        return redirect()->route('Manajement.Permissions.index')->with('success_created', 'Hak akses <b>'.$has_been_validate['name'].'</b> telah berhasil dibuat !');
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
        $Navigator = new HomeController;
        $latest_inbox = $Navigator->GetLatestInbox();
        $latest_notification = $Navigator->GetLatestNotification();
        return view('Manajement.Permissions.edit', compact('data', 'title', 'latest_inbox', 'latest_notification'));
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
        return redirect()->route('Manajement.Permissions.index')->with('success_updated', 'Hak akses <b>'.$permission->name.'</b> telah berhasil diupdate !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Permission::findOrFail($id);
        $data->delete();
        return redirect()->route('Manajement.Permissions.index')->with('success_deleted', 'Hak akses <b>'.$data->name.'</b> telah berhasil dihapus !');
    }
}
