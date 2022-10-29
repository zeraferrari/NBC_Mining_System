<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataTestingValidation;
use App\Models\DataTesting;
use App\Models\RhesusCategory;
use RealRashid\SweetAlert\Facades\Alert;

class DataTestingController extends Controller
{
    protected $title = 'Manajement Dashboard Data Testing';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $data = DataTesting::with('Rhesus_Connection')->get();
        $title = $this->title;
        $Navigator = new HomeController;
        $latest_inbox = $Navigator->GetLatestInbox();
        $latest_notification = $Navigator->GetLatestNotification();
        return view('Manajement.DataTestings.index', compact('data', 'title', 'latest_inbox', 'latest_notification'));
    }

    public function create(){
        $data_rhesus = RhesusCategory::all();
        $title = $this->title;
        $Navigator = new HomeController;
        $latest_inbox = $Navigator->GetLatestInbox();
        $latest_notification = $Navigator->GetLatestNotification();
        return view('Manajement.DataTestings.create', compact('data_rhesus', 'title', 'latest_inbox', 'latest_notification'));
    }

    public function store(DataTestingValidation $request){
        $naive_bayes = new CalculationNaiveBayesController;
        $result_classification = $naive_bayes->Classifier_Naive_Bayes(
                $request->Age,
                $request->Weight,
                $request->Hemoglobin,
                $request->Pressure_Sistole,
                $request->Pressure_diastole
        );
        $data_has_valid = $request->validated();
        $data_has_valid['Result_Classification'] = $result_classification[0]->Result_Classification;
        DataTesting::create($data_has_valid);
        return redirect()->route('Manajement.DataTestings.index')->with('success_created', 'Data testing atas nama <b>'.$data_has_valid['Name'].'</b> telah berhasil dibuat !');
    }

    public function edit($id){
        $data_rhesus = RhesusCategory::all();
        $data = DataTesting::find($id);
        $title = $this->title;
        $Navigator = new HomeController;
        $latest_inbox = $Navigator->GetLatestInbox();
        $latest_notification = $Navigator->GetLatestNotification();
        return view('Manajement.DataTestings.edit', compact('data_rhesus', 'data', 'title', 'latest_inbox', 'latest_notification'));
    }

    public function update(DataTestingValidation $request, $id){
        $data_has_valid = $request->validated();
        $naive_bayes = new CalculationNaiveBayesController;
        $result_classification = $naive_bayes->Classifier_Naive_Bayes(
            $request->Age,
            $request->Weight,
            $request->Hemoglobin,
            $request->Pressure_Sistole,
            $request->Pressure_diastole
        );
        $data_has_valid['Result_Classification'] = $result_classification[0]->Result_Classification;
        $data_testing = DataTesting::findorFail($id);
        $data_testing->update($data_has_valid);
        return redirect()->route('Manajement.DataTestings.index')->with('success_updated', 'Data testing atas nama <b>'.$data_testing->Name.'</b> telah berhasil diupdate !');
    }

    public function destroy($id){
        $data = DataTesting::findorFail($id);
        $data->delete();
        return redirect()->route('Manajement.DataTestings.index')->with('success_deleted', 'Data testing atas nama <b>'.$data->Name.'</b> telah berhasil dihapus !');
    }

    public function show($id){
        $data = DataTesting::with('Rhesus_Connection')->findorFail($id);
        $title = $this->title;
        $naive_bayes = new CalculationNaiveBayesController();
        $Result_Classification = $naive_bayes->Classifier_Naive_Bayes(
            $data->Age,
            $data->Weight,
            $data->Hemoglobin,
            $data->Pressure_Sistole,
            $data->Pressure_diastole
        );
        
        $Navigator = new HomeController;
        $latest_inbox = $Navigator->GetLatestInbox();
        $latest_notification = $Navigator->GetLatestNotification();
        return view('Manajement.DataTestings.show', compact('data', 'title',
        'Result_Classification', 'latest_inbox', 'latest_notification'));
    }
}
