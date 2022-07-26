<?php

namespace App\Http\Controllers;

use App\Http\Requests\RhesusValidation;
use App\Models\RhesusCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RhesusCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $title = 'Manajement Dashboard Rhesus';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = RhesusCategory::all();
        $title = $this->title;
        $Navigator = new HomeController;
        $latest_inbox = $Navigator->GetLatestInbox();
        $latest_notification = $Navigator->GetLatestNotification();
        return view('Manajement.Rhesus.index', compact('data', 'title', 'latest_inbox', 'latest_notification'));
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
        return view('Manajement.Rhesus.create', compact('title', 'latest_inbox', 'latest_notification'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RhesusValidation $request)
    {
        $data_has_been_valid = $request->validated();
        RhesusCategory::create($data_has_been_valid);
        return redirect()->route('Manajement.Rhesus.index')->with('success_created', 'Data rhesus <b>'.$data_has_been_valid['Name'].'</b> telah berhasil dibuat !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RhesusCategory  $rhesusCategory
     * @return \Illuminate\Http\Response
     */
    public function show(RhesusCategory $rhesusCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RhesusCategory  $rhesusCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = RhesusCategory::findOrFail($id);
        $title = $this->title;
        $Navigator = new HomeController;
        $latest_inbox = $Navigator->GetLatestInbox();
        $latest_notification = $Navigator->GetLatestNotification();
        return view('Manajement.Rhesus.edit', compact('data', 'title', 'latest_inbox', 'latest_notification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RhesusCategory  $rhesusCategory
     * @return \Illuminate\Http\Response
     */
    public function update(RhesusValidation $request, $id)
    {
        $data_has_been_valid = $request->validated();
        $data = RhesusCategory::find($id);
        $data->update($data_has_been_valid);
        return redirect()->route('Manajement.Rhesus.index')->with('success_updated','Data rhesus <b>'.$data->Name.'</b> telah berhasil diupdate !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RhesusCategory  $rhesusCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = RhesusCategory::findOrFail($id);
        $data->delete();
        return redirect()->route('Manajement.Rhesus.index')->with('success_deleted','Data rhesus <b>'.$data->Name.'</b> telah berhasil dihapus !');
    }
}
