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
        $result_classification = $naive_bayes->Calculation_Naive_Bayes($request->Hemoglobin,
                                                            $request->Pressure_Sistole,
                                                            $request->Pressure_diastole,
                                                                    $request->Weight,
                                                                        $request->Age);
        $data_has_valid = $request->validated();
        $data_has_valid['Result_Classification'] = $result_classification;
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
        $result_classification = $naive_bayes->Calculation_Naive_Bayes($request->Hemoglobin,
                                                                   $request->Pressure_Sistole,
                                                                    $request->Pressure_diastole,
                                                                            $request->Weight,
                                                                                $request->Age);
        $data_has_valid['Result_Classification'] = $result_classification;
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
        $total_data_training = $naive_bayes->getTotalDataTraining();
        $total_data_class_layak = $naive_bayes->getTotal_EachClass('Layak');
        $total_data_class_tidak_layak = $naive_bayes->getTotal_EachClass('Tidak Layak');

        $result_prior_probability_class_layak = $total_data_class_layak/$total_data_training;
        $result_prior_probability_class_tidak_layak = $total_data_class_tidak_layak/$total_data_training;

        $total_nilai_atr_umur_layak = $naive_bayes->getJumlahValue_EachAttribute('Layak', 'Age');
        $total_nilai_atr_umur_tidak_layak = $naive_bayes->getJumlahValue_EachAttribute('Tidak Layak', 'Age');
        // $total_data_distinct_atr_umur_layak = $naive_bayes->getTotal_Attribute_Distinct_EachClass('Age', 'Layak');
        // $total_data_distinct_atr_umur_tidak_layak = $naive_bayes->getTotal_Attribute_Distinct_EachClass('Age', 'Tidak Layak');
        $mean_atr_umur_layak = $naive_bayes->getMeanResult_EachClass($total_nilai_atr_umur_layak, $total_data_class_layak);
        $mean_atr_umur_tidak_layak = $naive_bayes->getMeanResult_EachClass($total_nilai_atr_umur_tidak_layak, $total_data_class_tidak_layak);
        $standar_deviasi_atr_umur_layak = $naive_bayes->getResultAttribute_Deviasi_EachClass('Layak', 'Age', $mean_atr_umur_layak, $total_data_class_layak);
        $standar_deviasi_atr_umur_tidak_layak = $naive_bayes->getResultAttribute_Deviasi_EachClass('Tidak Layak', 'Age', $mean_atr_umur_tidak_layak, $total_data_class_tidak_layak);
        $gaussian_atr_umur_layak = $naive_bayes->getResultDistribusi_Gaussian($data->Age, $mean_atr_umur_layak, $standar_deviasi_atr_umur_layak);
        $gaussian_atr_umur_tidak_layak = $naive_bayes->getResultDistribusi_Gaussian($data->Age, $mean_atr_umur_tidak_layak, $standar_deviasi_atr_umur_tidak_layak);

        $total_nilai_atr_bb_layak = $naive_bayes->getJumlahValue_EachAttribute('Layak', 'Weight');
        $total_nilai_atr_bb_tidak_layak = $naive_bayes->getJumlahValue_EachAttribute('Tidak Layak', 'Weight');
        // $total_data_distinct_atr_bb_layak = $naive_bayes->getTotal_Attribute_Distinct_EachClass('Weight', 'Layak');
        // $total_data_distinct_atr_bb_tidak_layak = $naive_bayes->getTotal_Attribute_Distinct_EachClass('Weight', 'Tidak Layak');
        $mean_atr_bb_layak = $naive_bayes->getMeanResult_EachClass($total_nilai_atr_bb_layak, $total_data_class_layak);
        $mean_atr_bb_tidak_layak = $naive_bayes->getMeanResult_EachClass($total_nilai_atr_bb_tidak_layak, $total_data_class_tidak_layak);
        $standar_deviasi_atr_bb_layak = $naive_bayes->getResultAttribute_Deviasi_EachClass('Layak', 'Weight', $mean_atr_bb_layak, $total_data_class_layak);
        $standar_deviasi_atr_bb_tidak_layak = $naive_bayes->getResultAttribute_Deviasi_EachClass('Tidak Layak', 'Weight', $mean_atr_bb_tidak_layak, $total_data_class_tidak_layak);
        $gaussian_atr_bb_layak = $naive_bayes->getResultDistribusi_Gaussian($data->Weight, $mean_atr_bb_layak, $standar_deviasi_atr_bb_layak);
        $gaussian_atr_bb_tidak_layak = $naive_bayes->getResultDistribusi_Gaussian($data->Weight, $mean_atr_bb_tidak_layak, $standar_deviasi_atr_bb_tidak_layak);

        $total_nilai_atr_hemoglobin_layak = $naive_bayes->getJumlahValue_EachAttribute('Layak', 'Hemoglobin');
        $total_nilai_atr_hemoglobin_tidak_layak = $naive_bayes->getJumlahValue_EachAttribute('Tidak Layak', 'Hemoglobin');
        // $total_data_distinct_atr_hemoglobin_layak = $naive_bayes->getTotal_Attribute_Distinct_EachClass('Hemoglobin', 'Layak');
        // $total_data_distinct_atr_hemoglobin_tidak_layak = $naive_bayes->getTotal_Attribute_Distinct_EachClass('Hemoglobin', 'Tidak Layak');
        $mean_atr_hemoglobin_layak = $naive_bayes->getMeanResult_EachClass($total_nilai_atr_hemoglobin_layak, $total_data_class_layak);
        $mean_atr_hemoglobin_tidak_layak = $naive_bayes->getMeanResult_EachClass($total_nilai_atr_hemoglobin_tidak_layak, $total_data_class_tidak_layak);
        $standar_deviasi_atr_hemoglobin_layak = $naive_bayes->getResultAttribute_Deviasi_EachClass('Layak', 'Hemoglobin', $mean_atr_hemoglobin_layak, $total_data_class_layak);
        $standar_deviasi_atr_hemoglobin_tidak_layak = $naive_bayes->getResultAttribute_Deviasi_EachClass('Tidak Layak', 'Hemoglobin', $mean_atr_hemoglobin_tidak_layak, $total_data_class_tidak_layak);
        $gaussian_atr_hemoglobin_layak = $naive_bayes->getResultDistribusi_Gaussian($data->Hemoglobin, $mean_atr_hemoglobin_layak, $standar_deviasi_atr_hemoglobin_layak);
        $gaussian_atr_hemoglobin_tidak_layak = $naive_bayes->getResultDistribusi_Gaussian($data->Hemoglobin, $mean_atr_hemoglobin_tidak_layak, $standar_deviasi_atr_hemoglobin_tidak_layak);


        $total_nilai_atr_p_sistole_layak = $naive_bayes->getJumlahValue_EachAttribute('Layak', 'Pressure_Sistole');
        $total_nilai_atr_p_sistole_tidak_layak = $naive_bayes->getJumlahValue_EachAttribute('Tidak Layak', 'Pressure_Sistole');
        // $total_data_distinct_atr_p_sistole_layak = $naive_bayes->getTotal_Attribute_Distinct_EachClass('Pressure_Sistole', 'Layak');
        // $total_data_distinct_atr_p_sistole_tidak_layak = $naive_bayes->getTotal_Attribute_Distinct_EachClass('Pressure_Sistole', 'Tidak Layak');
        $mean_atr_pressure_sistole_layak = $naive_bayes->getMeanResult_EachClass($total_nilai_atr_p_sistole_layak, $total_data_class_layak);
        $mean_atr_pressure_sistole_tidak_layak = $naive_bayes->getMeanResult_EachClass($total_nilai_atr_p_sistole_tidak_layak, $total_data_class_tidak_layak);
        $standar_deviasi_atr_pressure_sistole_layak = $naive_bayes->getResultAttribute_Deviasi_EachClass('Layak', 'Pressure_Sistole', $mean_atr_pressure_sistole_layak, $total_data_class_layak);
        $standar_deviasi_atr_pressure_sistole_tidak_layak = $naive_bayes->getResultAttribute_Deviasi_EachClass('Tidak Layak', 'Pressure_Sistole', $mean_atr_pressure_sistole_tidak_layak, $total_data_class_tidak_layak);
        $gaussian_atr_pressure_sistole_layak = $naive_bayes->getResultDistribusi_Gaussian($data->Pressure_Sistole, $mean_atr_pressure_sistole_layak, $standar_deviasi_atr_pressure_sistole_layak);
        $gaussian_atr_pressure_sistole_tidak_layak = $naive_bayes->getResultDistribusi_Gaussian($data->Pressure_Sistole, $mean_atr_pressure_sistole_tidak_layak, $standar_deviasi_atr_pressure_sistole_tidak_layak);


        $total_nilai_atr_p_diastole_layak = $naive_bayes->getJumlahValue_EachAttribute('Layak', 'Pressure_diastole');
        $total_nilai_atr_p_diastole_tidak_layak = $naive_bayes->getJumlahValue_EachAttribute('Tidak Layak', 'Pressure_diastole');
        // $total_data_distinct_atr_p_diastole_layak = $naive_bayes->getTotal_Attribute_Distinct_EachClass('Pressure_diastole', 'Layak');
        // $total_data_distinct_atr_p_diastole_tidak_layak = $naive_bayes->getTotal_Attribute_Distinct_EachClass('Pressure_diastole', 'Tidak Layak');
        $mean_atr_pressure_diastole_layak = $naive_bayes->getMeanResult_EachClass($total_nilai_atr_p_diastole_layak, $total_data_class_layak);
        $mean_atr_pressure_diastole_tidak_layak = $naive_bayes->getMeanResult_EachClass($total_nilai_atr_p_diastole_tidak_layak, $total_data_class_tidak_layak);
        $standar_deviasi_atr_pressure_diastole_layak = $naive_bayes->getResultAttribute_Deviasi_EachClass('Layak', 'Pressure_diastole', $mean_atr_pressure_diastole_layak, $total_data_class_layak);
        $standar_deviasi_atr_pressure_diastole_tidak_layak = $naive_bayes->getResultAttribute_Deviasi_EachClass('Tidak Layak', 'Pressure_diastole', $mean_atr_pressure_diastole_tidak_layak, $total_data_class_tidak_layak);
        $gaussian_atr_pressure_diastole_layak = $naive_bayes->getResultDistribusi_Gaussian($data->Pressure_diastole, $mean_atr_pressure_diastole_layak, $standar_deviasi_atr_pressure_diastole_layak);
        $gaussian_atr_pressure_diastole_tidak_layak = $naive_bayes->getResultDistribusi_Gaussian($data->Pressure_diastole, $mean_atr_pressure_diastole_tidak_layak, $standar_deviasi_atr_pressure_diastole_tidak_layak);
        
        $temp_probability_each_attribute_class_layak = [$gaussian_atr_umur_layak, $gaussian_atr_bb_layak, $gaussian_atr_hemoglobin_layak, $gaussian_atr_pressure_sistole_layak, $gaussian_atr_pressure_diastole_layak];
        $temp_probability_each_attribute_class_tidak_layak = [$gaussian_atr_umur_tidak_layak, $gaussian_atr_bb_tidak_layak, $gaussian_atr_hemoglobin_tidak_layak, $gaussian_atr_pressure_sistole_tidak_layak, $gaussian_atr_pressure_diastole_tidak_layak];

        $result_probability_each_attribute_class_layak = $naive_bayes->getProbability_EachClass($temp_probability_each_attribute_class_layak);
        $result_probability_each_attribute_class_tidak_layak = $naive_bayes->getProbability_EachClass($temp_probability_each_attribute_class_tidak_layak);


        $result_probability_class_layak = $result_probability_each_attribute_class_layak * $result_prior_probability_class_layak;
        $result_probability_class_tidak_layak = $result_probability_each_attribute_class_tidak_layak * $result_prior_probability_class_tidak_layak;

        $result_normalization_class_layak = $naive_bayes->getNormalizationProbability_EachClass($result_probability_class_layak, $result_probability_class_tidak_layak);
        $result_normalization_class_tidak_layak = $naive_bayes->getNormalizationProbability_EachClass($result_probability_class_tidak_layak, $result_probability_class_layak);
        
        $Navigator = new HomeController;
        $latest_inbox = $Navigator->GetLatestInbox();
        $latest_notification = $Navigator->GetLatestNotification();

        return view('Manajement.DataTestings.show', compact('data', 'title',
        'total_data_training',
        'total_data_class_layak', 'total_data_class_tidak_layak',
        'result_prior_probability_class_layak', 'result_prior_probability_class_tidak_layak', 

        'mean_atr_umur_layak', 'mean_atr_umur_tidak_layak',
        'standar_deviasi_atr_umur_layak', 'standar_deviasi_atr_umur_tidak_layak',
        'gaussian_atr_umur_layak', 'gaussian_atr_umur_tidak_layak',
        
        'mean_atr_bb_layak', 'mean_atr_bb_tidak_layak',
        'standar_deviasi_atr_bb_layak', 'standar_deviasi_atr_bb_tidak_layak',
        'gaussian_atr_bb_layak', 'gaussian_atr_bb_tidak_layak',

        'mean_atr_hemoglobin_layak', 'mean_atr_hemoglobin_tidak_layak',
        'standar_deviasi_atr_hemoglobin_layak', 'standar_deviasi_atr_hemoglobin_tidak_layak',
        'gaussian_atr_hemoglobin_layak', 'gaussian_atr_hemoglobin_tidak_layak',

        'mean_atr_pressure_sistole_layak', 'mean_atr_pressure_sistole_tidak_layak',
        'standar_deviasi_atr_pressure_sistole_layak', 'standar_deviasi_atr_pressure_sistole_tidak_layak',
        'gaussian_atr_pressure_sistole_layak', 'gaussian_atr_pressure_sistole_tidak_layak',
    
        'mean_atr_pressure_diastole_layak', 'mean_atr_pressure_diastole_tidak_layak',
        'standar_deviasi_atr_pressure_diastole_layak', 'standar_deviasi_atr_pressure_diastole_tidak_layak',
        'gaussian_atr_pressure_diastole_layak', 'gaussian_atr_pressure_diastole_tidak_layak',
    
        'result_probability_each_attribute_class_layak', 'result_probability_each_attribute_class_tidak_layak',
    
        'result_probability_class_layak', 'result_probability_class_tidak_layak',
    
        'result_normalization_class_layak', 'result_normalization_class_tidak_layak',
        'latest_inbox', 'latest_notification'));
    }
}
