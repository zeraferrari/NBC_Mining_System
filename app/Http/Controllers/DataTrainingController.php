<?php

namespace App\Http\Controllers;

use App\Models\DataTraining;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataTrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
         $data_training = DB::table('data_trainings')
         ->join('rhesus_categories', 'rhesus_categories.id', '=', 'data_trainings.rhesus_id')
         ->select('data_trainings.Name as Data_Trainings_Name', 'Gender', 'rhesus_categories.Name as Rhesus_Categories_Name', 'Status')->get();
        */

        $data_training = DataTraining::with('Rhesus_Connection')->get();
        return view('DataTraining.index', compact('data_training'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(DataTraining $dataTraining)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataTraining  $dataTraining
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataTraining $dataTraining)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataTraining  $dataTraining
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataTraining $dataTraining)
    {
        //
    }
}
