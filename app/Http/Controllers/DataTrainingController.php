<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataTrainingValidation;
use App\Models\DataTraining;
use App\Models\RhesusCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class DataTrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $title = 'Manajement Dashboard Data Training';

    public function index()
    {
        $title = $this->title;
        $data = DataTraining::with('Rhesus_Connection')->get();
        return view('Manajement.DataTrainings.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = $this->title;
        $data_rhesus = RhesusCategory::all();
        return view('Manajement.DataTrainings.create', compact('title', 'data_rhesus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DataTrainingValidation $request)
    {
        $data_has_been_validated = $request->validated();
        DataTraining::create($data_has_been_validated);
        Alert::success('Data berhasil dibuat !', 'Data dengan nama "'.$data_has_been_validated['Name'].'" Berhasil ditambahkan !');
        return redirect()->route('Manajement.DataTrainings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataTraining  $dataTraining
     * @return \Illuminate\Http\Response
     */
    public function show(DataTraining $dataTraining)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataTraining  $dataTraining
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DataTraining::find($id);
        $data_rhesus = RhesusCategory::all();
        $title = $this->title;
        return view('Manajement.DataTrainings.edit', compact('data', 'data_rhesus', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataTraining  $dataTraining
     * @return \Illuminate\Http\Response
     */
    public function update(DataTrainingValidation $request, $id)
    {
        $data_has_been_validated = $request->validated();
        $data = DataTraining::with('Rhesus_Connection')->find($id);
        $data->update($data_has_been_validated);
        return redirect()->route('Manajement.DataTrainings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataTraining  $dataTraining
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DataTraining::find($id)->delete();
        return redirect()->route('Manajement.DataTrainings.index');
    }
}
