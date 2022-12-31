<?php

namespace App\Http\Controllers;

use App\Models\DataTraining;
use Illuminate\Http\Request;

class CalculationNaiveBayesController extends Controller
{
    private $eksponensial = 2.71828183;
    private $vi = 3.14;

    public function getTotalDataTraining(){
        $the_calculation_result = DataTraining::count();
        return $the_calculation_result;
    }

    public function getTotal_EachClass($Class){
        $the_calculation_result = DataTraining::where('Status', $Class)->count();
        return $the_calculation_result;
    }


    public function GetResult_EachPriorProbabilityClass($CalculationEachClass, $TotalDataTraining){
        $the_calculation_result = $CalculationEachClass/$TotalDataTraining;
        return $the_calculation_result;
    }

    public function getJumlahValue_EachAttribute($Class,$attribute){
        $query = DataTraining::where('Status', $Class)->sum($attribute);
        return $query;
    }

    public function getTotal_Attribute_Distinct_EachClass($Attribute, $Class){
        $query = DataTraining::where('Status', $Class)->count($Attribute);
        return $query;
    }


    public function getMeanResult_EachClass($Result_ValueAttribute, $Total_EachClass){
        $the_calculation_result = $Result_ValueAttribute/$Total_EachClass;
        return $the_calculation_result;
    }

    public function getResultAttribute_Deviasi_EachClass($Class, $attribute, $mean_result, $Total_EachClass){
        $query = DataTraining::where('Status', $Class)->pluck($attribute);
        $array = array();
        foreach ($query as $key => $value) {    
            $each_data = pow(($query[$key]-$mean_result), 2);
            $array [] = $each_data;
        }
        $result_deviasi = sqrt(array_sum($array)/($Total_EachClass-1));
        return $result_deviasi;
    }

    public function getResultDistribusi_Gaussian($incoming_input, $mean_result, $deviasi_result){
        $Calculation_Gaussian = 1/(sqrt(2*$this->vi) * $deviasi_result) * (pow($this->eksponensial, - pow(($incoming_input-$mean_result),2)/(2*pow($deviasi_result, 2))));
        return $Calculation_Gaussian;
    }

    public function getProbability_EachClass($ResultGaussian_EachClass){
        $ResultProbability_EachClass = 1;

        foreach ($ResultGaussian_EachClass as $key => $value) {
            $ResultProbability_EachClass = $ResultProbability_EachClass * $ResultGaussian_EachClass[$key];
        }
        return $ResultProbability_EachClass;
    }

    public function getFinalProbability_EachClass($Result_EachProbabilityClass, $Result_Prior_Probability,){
        $Result_Final_Probability = $Result_EachProbabilityClass * $Result_Prior_Probability;
        return $Result_Final_Probability;
    }
    
    public function getNormalizationProbability_EachClass($ResultFinalProbability_Class_1, $ResultFinalProbability_Class_2){
        $Result_Normalization = $ResultFinalProbability_Class_1 / ($ResultFinalProbability_Class_1 + $ResultFinalProbability_Class_2);
        return $Result_Normalization;
    }
    
    public function Classifier_Naive_Bayes($Age, $Weight, $Hemoglobin, $PressureSistole, $PressureDiastole){
        /* First Step */
        $Total_Data_Trainings = $this->getTotalDataTraining();
        $Value_Class_Layak = $this->getTotal_EachClass('Layak');
        $Value_Class_Tidak_Layak = $this->getTotal_EachClass('Tidak Layak');
        $Prior_Prob_Layak = $this->GetResult_EachPriorProbabilityClass($Value_Class_Layak, $Total_Data_Trainings);
        $Prior_Prob_Tidak_Layak = $this->GetResult_EachPriorProbabilityClass($Value_Class_Tidak_Layak, $Total_Data_Trainings);
   
        /*============================================================= */

        /* Attribute Age ===========================================================*/
        $Value_Sum_Age_Class_Layak = $this->getJumlahValue_EachAttribute('Layak', 'Age');
        $Value_Sum_Age_Class_Tidak_Layak = $this->getJumlahValue_EachAttribute('Tidak Layak', 'Age');
        
        $Mean_Age_Class_Layak = $this->getMeanResult_EachClass($Value_Sum_Age_Class_Layak, $Value_Class_Layak);
        $Mean_Age_Class_Tidak_Layak = $this->getMeanResult_EachClass($Value_Sum_Age_Class_Tidak_Layak, $Value_Class_Tidak_Layak);
        
        $Standar_Deviasi_Age_Class_Layak = $this->getResultAttribute_Deviasi_EachClass('Layak', 'Age', $Mean_Age_Class_Layak, $Value_Class_Layak);
        $Standar_Deviasi_Age_Class_Tidak_Layak = $this->getResultAttribute_Deviasi_EachClass('Tidak Layak', 'Age', $Mean_Age_Class_Tidak_Layak, $Value_Class_Tidak_Layak);
        

        $Gaussian_Age_Class_Layak = $this->getResultDistribusi_Gaussian($Age, $Mean_Age_Class_Layak, $Standar_Deviasi_Age_Class_Layak);
        $Gaussian_Age_Class_Tidak_Layak = $this->getResultDistribusi_Gaussian($Age, $Mean_Age_Class_Tidak_Layak, $Standar_Deviasi_Age_Class_Tidak_Layak);
        
        /* Attribute Weight ====================================================================== */
        $Value_Sum_Weight_Class_Layak = $this->getJumlahValue_EachAttribute('Layak', 'Weight');
        $Value_Sum_Weight_Class_Tidak_Layak = $this->getJumlahValue_EachAttribute('Tidak Layak', 'Weight');
        
        $Mean_Weight_Class_Layak = $this->getMeanResult_EachClass($Value_Sum_Weight_Class_Layak, $Value_Class_Layak);
        $Mean_Weight_Class_Tidak_Layak = $this->getMeanResult_EachClass($Value_Sum_Weight_Class_Tidak_Layak, $Value_Class_Tidak_Layak);
        
        $Standar_Deviasi_Weight_Class_Layak = $this->getResultAttribute_Deviasi_EachClass('Layak', 'Weight', $Mean_Weight_Class_Layak, $Value_Class_Layak);
        $Standar_Deviasi_Weight_Class_Tidak_Layak = $this->getResultAttribute_Deviasi_EachClass('Tidak Layak', 'Weight', $Mean_Weight_Class_Tidak_Layak, $Value_Class_Tidak_Layak);

        $Gaussian_Weight_Class_Layak = $this->getResultDistribusi_Gaussian($Weight, $Mean_Weight_Class_Layak, $Standar_Deviasi_Weight_Class_Layak);
        $Gaussian_Weight_Class_Tidak_Layak = $this->getResultDistribusi_Gaussian($Weight, $Mean_Weight_Class_Tidak_Layak, $Standar_Deviasi_Weight_Class_Tidak_Layak);
        

        /* Attribute Hemoglobin ========================================================================================= */
        $Value_Sum_Hemoglobin_Class_Layak = $this->getJumlahValue_EachAttribute('Layak', 'Hemoglobin');
        $Value_Sum_Hemoglobin_Class_Tidak_Layak = $this->getJumlahValue_EachAttribute('Tidak Layak', 'Hemoglobin');

        $Mean_Hemoglobin_Class_Layak = $this->getMeanResult_EachClass($Value_Sum_Hemoglobin_Class_Layak, $Value_Class_Layak);
        $Mean_Hemoglobin_Class_Tidak_Layak = $this->getMeanResult_EachClass($Value_Sum_Hemoglobin_Class_Tidak_Layak, $Value_Class_Tidak_Layak);

        $Standar_Deviasi_Hemoglobin_Class_Layak = $this->getResultAttribute_Deviasi_EachClass('Layak', 'Hemoglobin', $Mean_Hemoglobin_Class_Layak, $Value_Class_Layak);
        $Standar_Deviasi_Hemoglobin_Class_Tidak_Layak = $this->getResultAttribute_Deviasi_EachClass('Tidak Layak', 'Hemoglobin', $Mean_Hemoglobin_Class_Tidak_Layak, $Value_Class_Tidak_Layak);
    
        $Gaussian_Hemoglobin_Class_Layak = $this->getResultDistribusi_Gaussian($Hemoglobin, $Mean_Hemoglobin_Class_Layak, $Standar_Deviasi_Hemoglobin_Class_Layak);
        $Gaussian_Hemoglobin_Class_Tidak_Layak = $this->getResultDistribusi_Gaussian($Hemoglobin, $Mean_Hemoglobin_Class_Tidak_Layak, $Standar_Deviasi_Hemoglobin_Class_Tidak_Layak);
        
        
        /* Attribute Pressure Sistole ====================================================================================== */
        $Value_Sum_Pressure_sistole_Class_Layak = $this->getJumlahValue_EachAttribute('Layak', 'Pressure_sistole');
        $Value_Sum_Pressure_sistole_Class_Tidak_Layak = $this->getJumlahValue_EachAttribute('Tidak Layak', 'Pressure_sistole');

        $Mean_Pressure_sistole_Class_Layak = $this->getMeanResult_EachClass($Value_Sum_Pressure_sistole_Class_Layak, $Value_Class_Layak);
        $Mean_Pressure_sistole_Class_Tidak_Layak = $this->getMeanResult_EachClass($Value_Sum_Pressure_sistole_Class_Tidak_Layak, $Value_Class_Tidak_Layak);

        $Standar_Deviasi_Pressure_sistole_Class_Layak = $this->getResultAttribute_Deviasi_EachClass('Layak', 'Pressure_sistole', $Mean_Pressure_sistole_Class_Layak, $Value_Class_Layak);
        $Standar_Deviasi_Pressure_sistole_Class_Tidak_Layak = $this->getResultAttribute_Deviasi_EachClass('Tidak Layak', 'Pressure_sistole', $Mean_Pressure_sistole_Class_Tidak_Layak, $Value_Class_Tidak_Layak);
    
        $Gaussian_Pressure_sistole_Class_Layak = $this->getResultDistribusi_Gaussian($PressureSistole, $Mean_Pressure_sistole_Class_Layak, $Standar_Deviasi_Pressure_sistole_Class_Layak);
        $Gaussian_Pressure_sistole_Class_Tidak_Layak = $this->getResultDistribusi_Gaussian($PressureSistole, $Mean_Pressure_sistole_Class_Tidak_Layak, $Standar_Deviasi_Pressure_sistole_Class_Tidak_Layak);
        
        /* Attribute Pressure Diastole */
        $Value_Sum_Pressure_diastole_Class_Layak = $this->getJumlahValue_EachAttribute('Layak', 'Pressure_diastole');
        $Value_Sum_Pressure_diastole_Class_Tidak_Layak = $this->getJumlahValue_EachAttribute('Tidak Layak', 'Pressure_diastole');

        $Mean_Pressure_diastole_Class_Layak = $this->getMeanResult_EachClass($Value_Sum_Pressure_diastole_Class_Layak, $Value_Class_Layak);
        $Mean_Pressure_diastole_Class_Tidak_Layak = $this->getMeanResult_EachClass($Value_Sum_Pressure_diastole_Class_Tidak_Layak, $Value_Class_Tidak_Layak);

        $Standar_Deviasi_Pressure_diastole_Class_Layak = $this->getResultAttribute_Deviasi_EachClass('Layak', 'Pressure_diastole', $Mean_Pressure_diastole_Class_Layak, $Value_Class_Layak);
        $Standar_Deviasi_Pressure_diastole_Class_Tidak_Layak = $this->getResultAttribute_Deviasi_EachClass('Tidak Layak', 'Pressure_diastole', $Mean_Pressure_diastole_Class_Tidak_Layak, $Value_Class_Tidak_Layak);
    
        $Gaussian_Pressure_diastole_Class_Layak = $this->getResultDistribusi_Gaussian($PressureDiastole, $Mean_Pressure_diastole_Class_Layak, $Standar_Deviasi_Pressure_diastole_Class_Layak);
        $Gaussian_Pressure_diastole_Class_Tidak_Layak = $this->getResultDistribusi_Gaussian($PressureDiastole, $Mean_Pressure_diastole_Class_Tidak_Layak, $Standar_Deviasi_Pressure_diastole_Class_Tidak_Layak);


        /* Result Gaussian All Attribute Class Layak*/
        $Gaussian_Class_Layak = [$Gaussian_Age_Class_Layak, $Gaussian_Hemoglobin_Class_Layak
                                ,$Gaussian_Weight_Class_Layak, $Gaussian_Pressure_sistole_Class_Layak,
                                $Gaussian_Pressure_diastole_Class_Layak];

        /* Result Gaussian All Attribute Class Tidak Layak */
        $Gaussian_Class_Tidak_Layak = [$Gaussian_Age_Class_Tidak_Layak, $Gaussian_Hemoglobin_Class_Tidak_Layak
                                    , $Gaussian_Weight_Class_Tidak_Layak, $Gaussian_Pressure_sistole_Class_Tidak_Layak
                                    , $Gaussian_Pressure_diastole_Class_Tidak_Layak];

        /* Result Probability Temporary Each Class */
        $Temp_Probability_Class_Layak = $this->getProbability_EachClass($Gaussian_Class_Layak);
        $Temp_Probability_Class_Tidak_Layak = $this->getProbability_EachClass($Gaussian_Class_Tidak_Layak);
    
        /* Result Probability Final Without Normalization Each Class */
        $FinalProbability_Class_Layak = $this->getFinalProbability_EachClass($Temp_Probability_Class_Layak, $Prior_Prob_Layak);
        $FinalProbability_Class_Tidak_Layak = $this->getFinalProbability_EachClass($Temp_Probability_Class_Tidak_Layak, $Prior_Prob_Tidak_Layak);

        /* Value Normalization Each Class */
        $Normalization_Class_Layak = $this->getNormalizationProbability_EachClass($FinalProbability_Class_Layak, $FinalProbability_Class_Tidak_Layak);
        $Normalization_Class_Tidak_Layak = $this->getNormalizationProbability_EachClass($FinalProbability_Class_Tidak_Layak, $FinalProbability_Class_Layak);

        if($Normalization_Class_Layak > $Normalization_Class_Tidak_Layak){
            $Result_Normalization_Classifier = 'Layak';
        }else{
            $Result_Normalization_Classifier = 'Tidak Layak';
        }

        $Container_Mean_All_Attribute_Class_Layak = [
            'Age'               => $Mean_Age_Class_Layak,
            'Weight'            => $Mean_Weight_Class_Layak,
            'Hemoglobin'        => $Mean_Hemoglobin_Class_Layak,
            'Pressure_Sistole'  => $Mean_Pressure_sistole_Class_Layak,
            'Pressure_Diastole' => $Mean_Pressure_diastole_Class_Layak 
        ];

        $Container_Mean_All_Attribute_Class_Tidak_Layak = [
            'Age'               => $Mean_Age_Class_Tidak_Layak,
            'Weight'            => $Mean_Weight_Class_Tidak_Layak,
            'Hemoglobin'        => $Mean_Hemoglobin_Class_Tidak_Layak,
            'Pressure_Sistole'  => $Mean_Pressure_sistole_Class_Tidak_Layak,
            'Pressure_Diastole' => $Mean_Pressure_diastole_Class_Tidak_Layak 
        ];

        $Container_Standar_Deviasi_All_Attribute_Class_Layak = [
            'Age'               => $Standar_Deviasi_Age_Class_Layak,
            'Weight'            => $Standar_Deviasi_Weight_Class_Layak,
            'Hemoglobin'        => $Standar_Deviasi_Hemoglobin_Class_Layak,
            'Pressure_Sistole'  => $Standar_Deviasi_Pressure_sistole_Class_Layak,
            'Pressure_Diastole' => $Standar_Deviasi_Pressure_diastole_Class_Layak
        ];

        $Container_Standar_Deviasi_All_Attribute_Class_Tidak_Layak = [
            'Age'               => $Standar_Deviasi_Age_Class_Tidak_Layak,
            'Weight'            => $Standar_Deviasi_Weight_Class_Tidak_Layak,
            'Hemoglobin'        => $Standar_Deviasi_Hemoglobin_Class_Tidak_Layak,
            'Pressure_Sistole'  => $Standar_Deviasi_Pressure_sistole_Class_Tidak_Layak,
            'Pressure_Diastole' => $Standar_Deviasi_Pressure_diastole_Class_Tidak_Layak
        ];

        $Container_Gaussian_All_Attribute_Class_Layak = [
            'Age'               => $Gaussian_Age_Class_Layak,
            'Weight'            => $Gaussian_Weight_Class_Layak,
            'Hemoglobin'        => $Gaussian_Hemoglobin_Class_Layak,
            'Pressure_Sistole'  => $Gaussian_Pressure_sistole_Class_Layak,
            'Pressure_Diastole' => $Gaussian_Pressure_diastole_Class_Layak
        ];

        $Container_Gaussian_All_Attribute_Class_Tidak_Layak = [
            'Age'               => $Gaussian_Age_Class_Tidak_Layak,
            'Weight'            => $Gaussian_Weight_Class_Tidak_Layak,
            'Hemoglobin'        => $Gaussian_Hemoglobin_Class_Tidak_Layak,
            'Pressure_Sistole'  => $Gaussian_Pressure_sistole_Class_Tidak_Layak,
            'Pressure_Diastole' => $Gaussian_Pressure_diastole_Class_Tidak_Layak
        ];

        $Mean_Each_Class = [
            'Class_Layak'       => $Container_Mean_All_Attribute_Class_Layak,
            'Class_Tidak_Layak' => $Container_Mean_All_Attribute_Class_Tidak_Layak
        ];

        $Standar_Deviasi_Each_Class = [
            'Class_Layak'       =>  $Container_Standar_Deviasi_All_Attribute_Class_Layak,
            'Class_Tidak_Layak' =>  $Container_Standar_Deviasi_All_Attribute_Class_Tidak_Layak
        ];

        $Gaussian_Each_Class = [
            'Class_Layak'       =>  $Container_Gaussian_All_Attribute_Class_Layak,
            'Class_Tidak_Layak' =>  $Container_Gaussian_All_Attribute_Class_Tidak_Layak
        ];

        $Probability_All_Attribute_Each_Class = [
            'Class_Layak'       =>  $Temp_Probability_Class_Layak,
            'Class_Tidak_Layak' =>  $Temp_Probability_Class_Tidak_Layak
        ];

        $Probability_Each_Class_Without_Normalization = [
            'Class_Layak'       =>  $FinalProbability_Class_Layak,
            'Class_Tidak_Layak' =>  $FinalProbability_Class_Tidak_Layak
        ];

        $Probability_Each_Class_Normalization = [
            'Class_Layak'       =>  $Normalization_Class_Layak,
            'Class_Tidak_Layak' =>  $Normalization_Class_Tidak_Layak
        ];
        
        $temp = [];

        array_push($temp, (object)[
            'Total_Data_Trainings'              => $Total_Data_Trainings,
            'TotalValue_Class_Layak'            => $Value_Class_Layak,
            'TotalValue_Class_Tidak_Layak'      => $Value_Class_Tidak_Layak,
            'Prior_Prob_Class_Layak'            => $Prior_Prob_Layak,
            'Prior_Prob_Class_Tidak_Layak'      => $Prior_Prob_Tidak_Layak,
            'Mean_Each_Class'                   => $Mean_Each_Class,
            'Standar_Deviasi_Each_Class'        => $Standar_Deviasi_Each_Class,
            'Gaussian_Each_Class'               => $Gaussian_Each_Class,
            'Probability_All_Attribute_Each_Class'  =>  $Probability_All_Attribute_Each_Class,
            'Probability_Each_Class_Not_Normalization'  => $Probability_Each_Class_Without_Normalization,
            'Probability_Each_Class_Normalization'  =>  $Probability_Each_Class_Normalization,
            'Result_Classification' => $Result_Normalization_Classifier
        ]);
        
        return $temp;
    }

    public function Core_Classification($Age, $Weight, $Hemoglobin, $Pressure_Sistole, $Pressure_Diastole){
        $Total_Data_Trainings = $this->getTotalDataTraining();
        $Value_Class_Layak = $this->getTotal_EachClass('Layak');
        $Value_Class_Tidak_Layak = $this->getTotal_EachClass('Tidak Layak');
        $Prior_Prob_Layak = $this->GetResult_EachPriorProbabilityClass($Value_Class_Layak, $Total_Data_Trainings);
        $Prior_Prob_Tidak_Layak = $this->GetResult_EachPriorProbabilityClass($Value_Class_Tidak_Layak, $Total_Data_Trainings);

        /* Attribute Age ===========================================================*/
        $Value_Sum_Age_Class_Layak = $this->getJumlahValue_EachAttribute('Layak', 'Age');
        $Value_Sum_Age_Class_Tidak_Layak = $this->getJumlahValue_EachAttribute('Tidak Layak', 'Age');
        
        $Mean_Age_Class_Layak = $this->getMeanResult_EachClass($Value_Sum_Age_Class_Layak, $Value_Class_Layak);
        $Mean_Age_Class_Tidak_Layak = $this->getMeanResult_EachClass($Value_Sum_Age_Class_Tidak_Layak, $Value_Class_Tidak_Layak);

        $Standar_Deviasi_Age_Class_Layak = $this->getResultAttribute_Deviasi_EachClass('Layak', 'Age', $Mean_Age_Class_Layak, $Value_Class_Layak);
        $Standar_Deviasi_Age_Class_Tidak_Layak = $this->getResultAttribute_Deviasi_EachClass('Tidak Layak', 'Age', $Mean_Age_Class_Tidak_Layak, $Value_Class_Tidak_Layak);
        
        $Gaussian_Age_Class_Layak = $this->getResultDistribusi_Gaussian($Age, $Mean_Age_Class_Layak, $Standar_Deviasi_Age_Class_Layak);
        $Gaussian_Age_Class_Tidak_Layak = $this->getResultDistribusi_Gaussian($Age, $Mean_Age_Class_Tidak_Layak, $Standar_Deviasi_Age_Class_Tidak_Layak);
        
        /* Attribute Weight ====================================================================== */
        $Value_Sum_Weight_Class_Layak = $this->getJumlahValue_EachAttribute('Layak', 'Weight');
        $Value_Sum_Weight_Class_Tidak_Layak = $this->getJumlahValue_EachAttribute('Tidak Layak', 'Weight');

        $Mean_Weight_Class_Layak = $this->getMeanResult_EachClass($Value_Sum_Weight_Class_Layak, $Value_Class_Layak);
        $Mean_Weight_Class_Tidak_Layak = $this->getMeanResult_EachClass($Value_Sum_Weight_Class_Tidak_Layak, $Value_Class_Tidak_Layak);

        $Standar_Deviasi_Weight_Class_Layak = $this->getResultAttribute_Deviasi_EachClass('Layak', 'Weight', $Mean_Weight_Class_Layak, $Value_Class_Layak);
        $Standar_Deviasi_Weight_Class_Tidak_Layak = $this->getResultAttribute_Deviasi_EachClass('Tidak Layak', 'Weight', $Mean_Weight_Class_Tidak_Layak, $Value_Class_Tidak_Layak);
    
        $Gaussian_Weight_Class_Layak = $this->getResultDistribusi_Gaussian($Weight, $Mean_Weight_Class_Layak, $Standar_Deviasi_Weight_Class_Layak);
        $Gaussian_Weight_Class_Tidak_Layak = $this->getResultDistribusi_Gaussian($Weight, $Mean_Weight_Class_Tidak_Layak, $Standar_Deviasi_Weight_Class_Tidak_Layak);
        

        /* Attribute Hemoglobin ========================================================================================= */
        $Value_Sum_Hemoglobin_Class_Layak = $this->getJumlahValue_EachAttribute('Layak', 'Hemoglobin');
        $Value_Sum_Hemoglobin_Class_Tidak_Layak = $this->getJumlahValue_EachAttribute('Tidak Layak', 'Hemoglobin');

        $Mean_Hemoglobin_Class_Layak = $this->getMeanResult_EachClass($Value_Sum_Hemoglobin_Class_Layak, $Value_Class_Layak);
        $Mean_Hemoglobin_Class_Tidak_Layak = $this->getMeanResult_EachClass($Value_Sum_Hemoglobin_Class_Tidak_Layak, $Value_Class_Tidak_Layak);

        $Standar_Deviasi_Hemoglobin_Class_Layak = $this->getResultAttribute_Deviasi_EachClass('Layak', 'Hemoglobin', $Mean_Hemoglobin_Class_Layak, $Value_Class_Layak);
        $Standar_Deviasi_Hemoglobin_Class_Tidak_Layak = $this->getResultAttribute_Deviasi_EachClass('Tidak Layak', 'Hemoglobin', $Mean_Hemoglobin_Class_Tidak_Layak, $Value_Class_Tidak_Layak);
    
        $Gaussian_Hemoglobin_Class_Layak = $this->getResultDistribusi_Gaussian($Hemoglobin, $Mean_Hemoglobin_Class_Layak, $Standar_Deviasi_Hemoglobin_Class_Layak);
        $Gaussian_Hemoglobin_Class_Tidak_Layak = $this->getResultDistribusi_Gaussian($Hemoglobin, $Mean_Hemoglobin_Class_Tidak_Layak, $Standar_Deviasi_Hemoglobin_Class_Tidak_Layak);
        
        
        /* Attribute Pressure Sistole ====================================================================================== */
        $Value_Sum_Pressure_sistole_Class_Layak = $this->getJumlahValue_EachAttribute('Layak', 'Pressure_sistole');
        $Value_Sum_Pressure_sistole_Class_Tidak_Layak = $this->getJumlahValue_EachAttribute('Tidak Layak', 'Pressure_sistole');

        $Mean_Pressure_sistole_Class_Layak = $this->getMeanResult_EachClass($Value_Sum_Pressure_sistole_Class_Layak, $Value_Class_Layak);
        $Mean_Pressure_sistole_Class_Tidak_Layak = $this->getMeanResult_EachClass($Value_Sum_Pressure_sistole_Class_Tidak_Layak, $Value_Class_Tidak_Layak);

        $Standar_Deviasi_Pressure_sistole_Class_Layak = $this->getResultAttribute_Deviasi_EachClass('Layak', 'Pressure_sistole', $Mean_Pressure_sistole_Class_Layak, $Value_Class_Layak);
        $Standar_Deviasi_Pressure_sistole_Class_Tidak_Layak = $this->getResultAttribute_Deviasi_EachClass('Tidak Layak', 'Pressure_sistole', $Mean_Pressure_sistole_Class_Tidak_Layak, $Value_Class_Tidak_Layak);
    
        $Gaussian_Pressure_sistole_Class_Layak = $this->getResultDistribusi_Gaussian($Pressure_Sistole, $Mean_Pressure_sistole_Class_Layak, $Standar_Deviasi_Pressure_sistole_Class_Layak);
        $Gaussian_Pressure_sistole_Class_Tidak_Layak = $this->getResultDistribusi_Gaussian($Pressure_Sistole, $Mean_Pressure_sistole_Class_Tidak_Layak, $Standar_Deviasi_Pressure_sistole_Class_Tidak_Layak);
        
        /* Attribute Pressure Diastole */
        $Value_Sum_Pressure_diastole_Class_Layak = $this->getJumlahValue_EachAttribute('Layak', 'Pressure_diastole');
        $Value_Sum_Pressure_diastole_Class_Tidak_Layak = $this->getJumlahValue_EachAttribute('Tidak Layak', 'Pressure_diastole');

        $Mean_Pressure_diastole_Class_Layak = $this->getMeanResult_EachClass($Value_Sum_Pressure_diastole_Class_Layak, $Value_Class_Layak);
        $Mean_Pressure_diastole_Class_Tidak_Layak = $this->getMeanResult_EachClass($Value_Sum_Pressure_diastole_Class_Tidak_Layak, $Value_Class_Tidak_Layak);

        $Standar_Deviasi_Pressure_diastole_Class_Layak = $this->getResultAttribute_Deviasi_EachClass('Layak', 'Pressure_diastole', $Mean_Pressure_diastole_Class_Layak, $Value_Class_Layak);
        $Standar_Deviasi_Pressure_diastole_Class_Tidak_Layak = $this->getResultAttribute_Deviasi_EachClass('Tidak Layak', 'Pressure_diastole', $Mean_Pressure_diastole_Class_Tidak_Layak, $Value_Class_Tidak_Layak);
    
        $Gaussian_Pressure_diastole_Class_Layak = $this->getResultDistribusi_Gaussian($Pressure_Diastole, $Mean_Pressure_diastole_Class_Layak, $Standar_Deviasi_Pressure_diastole_Class_Layak);
        $Gaussian_Pressure_diastole_Class_Tidak_Layak = $this->getResultDistribusi_Gaussian($Pressure_Diastole, $Mean_Pressure_diastole_Class_Tidak_Layak, $Standar_Deviasi_Pressure_diastole_Class_Tidak_Layak);
        
        /* Result Gaussian All Attribute Class Layak*/
        $Gaussian_Class_Layak = [$Gaussian_Age_Class_Layak, $Gaussian_Hemoglobin_Class_Layak
                                ,$Gaussian_Weight_Class_Layak, $Gaussian_Pressure_sistole_Class_Layak,
                                $Gaussian_Pressure_diastole_Class_Layak];

        /* Result Gaussian All Attribute Class Tidak Layak */
        $Gaussian_Class_Tidak_Layak = [$Gaussian_Age_Class_Tidak_Layak, $Gaussian_Hemoglobin_Class_Tidak_Layak
                                    , $Gaussian_Weight_Class_Tidak_Layak, $Gaussian_Pressure_sistole_Class_Tidak_Layak
                                    , $Gaussian_Pressure_diastole_Class_Tidak_Layak];

        /* Result Probability Temporary Each Class */
        $Temp_Probability_Class_Layak = $this->getProbability_EachClass($Gaussian_Class_Layak);
        $Temp_Probability_Class_Tidak_Layak = $this->getProbability_EachClass($Gaussian_Class_Tidak_Layak);
    
        /* Result Probability Final Without Normalization Each Class */
        $FinalProbability_Class_Layak = $this->getFinalProbability_EachClass($Temp_Probability_Class_Layak, $Prior_Prob_Layak);
        $FinalProbability_Class_Tidak_Layak = $this->getFinalProbability_EachClass($Temp_Probability_Class_Tidak_Layak, $Prior_Prob_Tidak_Layak);

        $Normalization_Class_Layak = $this->getNormalizationProbability_EachClass($FinalProbability_Class_Layak, $FinalProbability_Class_Tidak_Layak);
        $Normalization_Class_Tidak_Layak = $this->getNormalizationProbability_EachClass($FinalProbability_Class_Tidak_Layak, $FinalProbability_Class_Layak);

        if($Normalization_Class_Layak > $Normalization_Class_Tidak_Layak){
            $Result_Normalization_Classifier = 'Layak';
        }else{
            $Result_Normalization_Classifier = 'Tidak Layak';
        }

        $Container_Mean_All_Attribute_Class_Layak = [
            'Age'               => $Mean_Age_Class_Layak,
            'Weight'            => $Mean_Weight_Class_Layak,
            'Hemoglobin'        => $Mean_Hemoglobin_Class_Layak,
            'Pressure_Sistole'  => $Mean_Pressure_sistole_Class_Layak,
            'Pressure_Diastole' => $Mean_Pressure_diastole_Class_Layak 
        ];

        $Container_Mean_All_Attribute_Class_Tidak_Layak = [
            'Age'               => $Mean_Age_Class_Tidak_Layak,
            'Weight'            => $Mean_Weight_Class_Tidak_Layak,
            'Hemoglobin'        => $Mean_Hemoglobin_Class_Tidak_Layak,
            'Pressure_Sistole'  => $Mean_Pressure_sistole_Class_Tidak_Layak,
            'Pressure_Diastole' => $Mean_Pressure_diastole_Class_Tidak_Layak 
        ];

        $Container_Standar_Deviasi_All_Attribute_Class_Layak = [
            'Age'               => $Standar_Deviasi_Age_Class_Layak,
            'Weight'            => $Standar_Deviasi_Weight_Class_Layak,
            'Hemoglobin'        => $Standar_Deviasi_Hemoglobin_Class_Layak,
            'Pressure_Sistole'  => $Standar_Deviasi_Pressure_sistole_Class_Layak,
            'Pressure_Diastole' => $Standar_Deviasi_Pressure_diastole_Class_Layak
        ];

        $Container_Standar_Deviasi_All_Attribute_Class_Tidak_Layak = [
            'Age'               => $Standar_Deviasi_Age_Class_Tidak_Layak,
            'Weight'            => $Standar_Deviasi_Weight_Class_Tidak_Layak,
            'Hemoglobin'        => $Standar_Deviasi_Hemoglobin_Class_Tidak_Layak,
            'Pressure_Sistole'  => $Standar_Deviasi_Pressure_sistole_Class_Tidak_Layak,
            'Pressure_Diastole' => $Standar_Deviasi_Pressure_diastole_Class_Tidak_Layak
        ];

        $Container_Gaussian_All_Attribute_Class_Layak = [
            'Age'               => $Gaussian_Age_Class_Layak,
            'Weight'            => $Gaussian_Weight_Class_Layak,
            'Hemoglobin'        => $Gaussian_Hemoglobin_Class_Layak,
            'Pressure_Sistole'  => $Gaussian_Pressure_sistole_Class_Layak,
            'Pressure_Diastole' => $Gaussian_Pressure_diastole_Class_Layak
        ];

        $Container_Gaussian_All_Attribute_Class_Tidak_Layak = [
            'Age'               => $Gaussian_Age_Class_Tidak_Layak,
            'Weight'            => $Gaussian_Weight_Class_Tidak_Layak,
            'Hemoglobin'        => $Gaussian_Hemoglobin_Class_Tidak_Layak,
            'Pressure_Sistole'  => $Gaussian_Pressure_sistole_Class_Tidak_Layak,
            'Pressure_Diastole' => $Gaussian_Pressure_diastole_Class_Tidak_Layak
        ];

        $Mean_Each_Class = [
            'Class_Layak'       => $Container_Mean_All_Attribute_Class_Layak,
            'Class_Tidak_Layak' => $Container_Mean_All_Attribute_Class_Tidak_Layak
        ];

        $Standar_Deviasi_Each_Class = [
            'Class_Layak'       =>  $Container_Standar_Deviasi_All_Attribute_Class_Layak,
            'Class_Tidak_Layak' =>  $Container_Standar_Deviasi_All_Attribute_Class_Tidak_Layak
        ];

        $Gaussian_Each_Class = [
            'Class_Layak'       =>  $Container_Gaussian_All_Attribute_Class_Layak,
            'Class_Tidak_Layak' =>  $Container_Gaussian_All_Attribute_Class_Tidak_Layak
        ];

        $Probability_All_Attribute_Each_Class = [
            'Class_Layak'       =>  $Temp_Probability_Class_Layak,
            'Class_Tidak_Layak' =>  $Temp_Probability_Class_Tidak_Layak
        ];

        $Probability_Each_Class_Without_Normalization = [
            'Class_Layak'       =>  $FinalProbability_Class_Layak,
            'Class_Tidak_Layak' =>  $FinalProbability_Class_Tidak_Layak
        ];

        $Probability_Each_Class_Normalization = [
            'Class_Layak'       =>  $Normalization_Class_Layak,
            'Class_Tidak_Layak' =>  $Normalization_Class_Tidak_Layak
        ];

        $temp = [];

        array_push($temp, (object)[
            'Gaussian_Each_Class'               => $Gaussian_Each_Class,
            'Probability_All_Attribute_Each_Class'  =>  $Probability_All_Attribute_Each_Class,
            'Probability_Each_Class_Not_Normalization'  => $Probability_Each_Class_Without_Normalization,
            'Probability_Each_Class_Normalization'  =>  $Probability_Each_Class_Normalization,
            'Result_Classification' => $Result_Normalization_Classifier
        ]);
        
        return $temp;
    }
}
