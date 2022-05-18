<?php

namespace App\Http\Controllers;

use App\Models\DataTesting;
use App\Models\DataTraining;
use Illuminate\Http\Request;

class Dashboard_NBC extends Controller
{
    protected $title = 'Main Naive Bayes Dashboard';

    public function __construct()
    {
        $this->middleware('auth');
    }

    function getTotalDataTrainings(){
        $result = DataTraining::count();
        return $result;
    }

    function getTotalDataTestings(){
        $result = DataTesting::count();
        return $result;
    }

    function getTotalDatasets($TotalDataTrainings, $TotalDataTestings){
        $result = $TotalDataTrainings + $TotalDataTestings;
        return $result;
    }

    function getTotalEachClass_Data_Trainings(){
        $result = DataTraining::all()->countBy('Status');
        return $result;
    }

    function getTotalEachClass_Data_Testings(){
        $result = DataTesting::all()->countBy('Status');
        return $result;
    }

    function ObjDatasets(){
        $datasets = [];

        $amount_trainings = $this->getTotalDataTrainings();
        $amount_testings = $this->getTotalDataTestings();

        array_push($datasets, (object)[
            'label' =>  'Data Training',
            'data'  =>  [$amount_trainings],
            'borderColor'   =>  'rgba(98, 0, 168, 0.3)',
            'backgroundColor'   =>  'rgba(128, 0, 219, 0.5)',
        ], (object)[
            'label' =>  'Data Testing',
            'data'  =>  [$amount_testings],
            'borderColor'   =>  'rgba(0, 145, 138, 0.3)',
            'backgroundColor'   =>  'rgba(49, 204, 196, 0.5)',
        ]);

        return $datasets;
    }

    function ObjDataTrainings(){
        $datasets = [];
        $EachClass_Data_Training = $this->getTotalEachClass_Data_Trainings()->toArray();

        array_push($datasets, (object)[
            'label'     =>  'Class Layak',
            'data'      =>  [$EachClass_Data_Training['Layak']],
            'borderColor'   =>  'rgba(98, 0, 168, 0.3)',
            'backgroundColor'   =>  'rgba(128, 0, 219, 0.5)',  
        ], (object)[
            'label'     =>  'Class Tidak Layak',
            'data'      =>  [$EachClass_Data_Training['Tidak Layak']],
            'borderColor'   =>  'rgba(0, 145, 138, 0.3)',
            'backgroundColor'   =>  'rgba(49, 204, 196, 0.5)',  
        ]);

        return $datasets;
    }

    function ObjDataTestings(){
        $datasets = [];
        $EachClass_Data_Training = $this->getTotalEachClass_Data_Testings()->toArray();

        array_push($datasets, (object)[
            'label'     =>  'Class Layak',
            'data'      =>  [$EachClass_Data_Training['Layak']],
            'borderColor'   =>  'rgba(98, 0, 168, 0.3)',
            'backgroundColor'   =>  'rgba(128, 0, 219, 0.5)',  
        ], (object)[
            'label'     =>  'Class Tidak Layak',
            'data'      =>  [$EachClass_Data_Training['Tidak Layak'] ?? 0],
            'borderColor'   =>  'rgba(0, 145, 138, 0.3)',
            'backgroundColor'   =>  'rgba(49, 204, 196, 0.5)',  
        ]);

        return $datasets;
    }

    function ConfusionMatrix(){
        $True_Positive = 0;
        $False_Positive = 0;
        $False_Negative = 0;
        $True_Negative = 0;

        $confusion_matrix = [];

        $data_testing = DataTesting::all();
        
        foreach($data_testing as $data_testings){
            if($data_testings->Status == 'Layak' && $data_testings->Result_Classification == 'Layak'){
                $True_Positive++;
            } elseif($data_testings->Status == 'Tidak Layak' && $data_testings->Result_Classification == 'Layak') {
                $False_Positive++;
            } elseif($data_testings->Status == 'Layak' && $data_testings->Result_Classification == 'Tidak Layak'){
                $False_Negative++;
            } elseif($data_testings->Status == 'Tidak Layak' && $data_testings->Result_Classification == 'Tidak Layak'){
                $True_Negative++;
            }
        }

        array_push($confusion_matrix, (object)[
            'Result'    =>  'True Positive (TP)',
            'Count'     =>  $True_Positive,
        ], (object)[
            'Result'    =>  'False Positive (FP)',
            'Count'     =>  $False_Positive,
        ], (object)[
            'Result'    =>  'False Negative (FN)',
            'Count'     =>  $False_Negative,
        ], (object)[
            'Result'    =>  'True Negative (TN)',
            'Count'     =>  $True_Negative , 
        ]);

        return $confusion_matrix;
    }

    function AccuracyModel($confusion_matrix){
        $temp_value_count = [];

        foreach($confusion_matrix as $CountMatrix){
            $temp_value_count[] = $CountMatrix->Count;
        }

        $accuracy_model = ($confusion_matrix[0]->Count + $confusion_matrix[3]->Count) / (array_sum($temp_value_count));

        if($accuracy_model < 1){
            return $accuracy_model = substr_replace(substr(round($accuracy_model, 4), 2), '.', 2, 0);
        }elseif($accuracy_model == 1){
            return $accuracy_model = 100;
        }
    }

    function PrecisionModel($confusion_matrix){
        $precision_model = round(($confusion_matrix[0]->Count / ($confusion_matrix[0]->Count + $confusion_matrix[1]->Count)) * 100, 2);
        return $precision_model;
    }

    function RecallModel($confusion_matrix){
        $recall_model = round(($confusion_matrix[0]->Count / ($confusion_matrix[0]->Count + $confusion_matrix[3]->Count)) * 100, 2);
        return $recall_model;
    }


    public function index(){
        $amount_trainings = $this->getTotalDataTrainings();
        $amount_testings = $this->getTotalDataTestings();
        $amount_datasets = $this->getTotalDatasets($amount_trainings, $amount_testings);
        $datasets = json_encode($this->ObjDatasets());
        $structure_data_trainings = json_encode($this->ObjDataTrainings());
        $structure_data_testings = json_encode($this->ObjDataTestings());
        $confusion_matrix = $this->ConfusionMatrix();
        $accuracy_model = $this->AccuracyModel($confusion_matrix);
        $precision_model = $this->PrecisionModel($confusion_matrix);
        $recall_model = $this->RecallModel($confusion_matrix);
        
        
        return view('Manajement.NBC_Dashboard.index',
            ['title' => $this->title,
                    'amount_trainings' => $amount_trainings,
                    'amount_testings'  => $amount_testings,
                    'amount_datasets'  => $amount_datasets,
                    'datasets'         => $datasets,
                    'structure_data_trainings'   =>  $structure_data_trainings,
                    'structure_data_testings'   =>  $structure_data_testings,
                    'confusion_matrix'  => $confusion_matrix,
                    'accuracy_model'    => $accuracy_model,
                    'precision_model'   => $precision_model,
                    'recall_model'      => $recall_model,
            ]);
    }
}
