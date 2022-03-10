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
            $each_data = pow($query[$key]-$mean_result, 2);
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
    
    public function Calculation_Naive_Bayes($Hemoglobin_Value, $PressureSistole_Value, $PressureDistoel_Value, $Weight_Value, $Age_Value){
        $Total_data_trainings = $this->getTotalDataTraining();
        $Data_Class_Layak = $this->getTotal_EachClass('Layak');
        $Data_Class_Tidak_Layak = $this->getTotal_EachClass('Tidak Layak');        
        $Result_Prior_Prob_Layak = $this->GetResult_EachPriorProbabilityClass($Data_Class_Layak, $Total_data_trainings);
        $Result_Prior_Prob_Tidak_Layak = $this->GetResult_EachPriorProbabilityClass($Data_Class_Tidak_Layak, $Total_data_trainings);
        
        /* Attribute Hemoglobin */
        $Value_Hemoglobin_Class_Layak = $this->getJumlahValue_EachAttribute('Layak', 'Hemoglobin');
        $Value_Hemoglobin_Class_Tidak_Layak = $this->getJumlahValue_EachAttribute('Tidak Layak', 'Hemoglobin');
    
        $Result_Mean_Hemoglobin_Class_Layak = $this->getMeanResult_EachClass($Value_Hemoglobin_Class_Layak, $Data_Class_Layak);
        $Result_Mean_Hemoglobin_Class_Tidak_Layak = $this->getMeanResult_EachClass($Value_Hemoglobin_Class_Tidak_Layak, $Data_Class_Tidak_Layak);

        $Result_Deviasi_Hemoglobin_Class_Layak = $this->getResultAttribute_Deviasi_EachClass('Layak', 'Hemoglobin', $Result_Mean_Hemoglobin_Class_Layak, $Data_Class_Layak);
        $Result_Deviasi_Hemoglobin_Class_Tidak_Layak = $this->getResultAttribute_Deviasi_EachClass('Layak', 'Hemoglobin', $Result_Mean_Hemoglobin_Class_Tidak_Layak, $Data_Class_Tidak_Layak);

        $Result_Gaussian_Hemoglobin_Class_Layak = $this->getResultDistribusi_Gaussian($Hemoglobin_Value, $Result_Mean_Hemoglobin_Class_Layak, $Result_Deviasi_Hemoglobin_Class_Layak);
        $Result_Gaussian_Hemoglobin_Class_Tidak_Layak = $this->getResultDistribusi_Gaussian($Hemoglobin_Value, $Result_Mean_Hemoglobin_Class_Tidak_Layak, $Result_Deviasi_Hemoglobin_Class_Tidak_Layak);
    
        /*================================================================================================================================================================================================================================================= */
        
        /* Attribute Pressure Sistole */
        $Value_Sistole_Class_Layak = $this->getJumlahValue_EachAttribute('Layak', 'Pressure_Sistole');
        $Value_Sistole_Class_Tidak_Layak = $this->getJumlahValue_EachAttribute('Tidak Layak', 'Pressure_Sistole');
        
        $Result_Mean_Sistole_Class_Layak = $this->getMeanResult_EachClass($Value_Sistole_Class_Layak, $Data_Class_Layak);
        $Result_Mean_Sistole_Class_Tidak_Layak = $this->getMeanResult_EachClass($Value_Sistole_Class_Tidak_Layak, $Data_Class_Tidak_Layak);
        
        $Result_Deviasi_Sistole_Class_Layak = $this->getResultAttribute_Deviasi_EachClass('Layak', 'Pressure_Sistole', $Result_Mean_Sistole_Class_Layak, $Data_Class_Layak);
        $Result_Deviasi_Sistole_Class_Tidak_Layak = $this->getResultAttribute_Deviasi_EachClass('Tidak Layak', 'Pressure_Sistole', $Result_Mean_Sistole_Class_Tidak_Layak, $Data_Class_Tidak_Layak);
        
        $Result_Gaussian_Sistole_Class_Layak = $this->getResultDistribusi_Gaussian($PressureSistole_Value, $Result_Mean_Sistole_Class_Layak, $Result_Deviasi_Sistole_Class_Layak);
        $Result_Gaussian_Sistole_Class_Tidak_Layak = $this->getResultDistribusi_Gaussian($PressureSistole_Value, $Result_Mean_Sistole_Class_Tidak_Layak, $Result_Deviasi_Sistole_Class_Tidak_Layak);
        
        /*================================================================================================================================================================================================================================================= */
        
        /* Attribute Pressure Diastole */
        
        $Value_Diastole_Class_Layak = $this->getJumlahValue_EachAttribute('Layak', 'Pressure_diastole');
        $Value_Diastole_Class_Tidak_Layak = $this->getJumlahValue_EachAttribute('Tidak Layak', 'Pressure_diastole');
        
        $Result_Mean_Diastole_Class_Layak = $this->getMeanResult_EachClass($Value_Diastole_Class_Layak, $Data_Class_Layak);
        $Result_Mean_Diastole_Class_Tidak_Layak = $this->getMeanResult_EachClass($Value_Diastole_Class_Tidak_Layak, $Data_Class_Tidak_Layak);
        
        $Result_Deviasi_Diastole_Class_Layak = $this->getResultAttribute_Deviasi_EachClass('Layak', 'Pressure_diastole', $Result_Mean_Diastole_Class_Layak, $Data_Class_Layak);
        $Result_Deviasi_Diastole_Class_Tidak_Layak = $this->getResultAttribute_Deviasi_EachClass('Tidak Layak', 'Pressure_diastole', $Result_Mean_Diastole_Class_Tidak_Layak, $Data_Class_Tidak_Layak);
        
        $Result_Gaussian_Diastole_Class_Layak = $this->getResultDistribusi_Gaussian($PressureDistoel_Value, $Result_Mean_Diastole_Class_Layak, $Result_Deviasi_Diastole_Class_Layak);
        $Result_Gaussian_Diastole_Class_Tidak_Layak = $this->getResultDistribusi_Gaussian($PressureDistoel_Value, $Result_Mean_Diastole_Class_Tidak_Layak, $Result_Deviasi_Diastole_Class_Tidak_Layak);
         
        /*================================================================================================================================================================================================================================================= */
        
        /* Attribute Weight */
        
        $Value_Weight_Class_Layak = $this->getJumlahValue_EachAttribute('Layak', 'Weight');
        $Value_Weight_Class_Tidak_Layak = $this->getJumlahValue_EachAttribute('Tidak Layak', 'Weight');
        
        $Result_Mean_Weight_Class_Layak = $this->getMeanResult_EachClass($Value_Weight_Class_Layak, $Data_Class_Layak);
        $Result_Mean_Weight_Class_Tidak_Layak = $this->getMeanResult_EachClass($Value_Weight_Class_Tidak_Layak, $Data_Class_Tidak_Layak);
        
        $Result_Deviasi_Weight_Class_Layak = $this->getResultAttribute_Deviasi_EachClass('Layak', 'Weight', $Result_Mean_Weight_Class_Layak, $Data_Class_Layak);
        $Result_Deviasi_Weight_Class_Tidak_Layak = $this->getResultAttribute_Deviasi_EachClass('Tidak Layak', 'Weight', $Result_Mean_Weight_Class_Tidak_Layak, $Data_Class_Tidak_Layak);
        
        $Result_Gaussian_Weight_Class_Layak = $this->getResultDistribusi_Gaussian($Weight_Value, $Result_Mean_Weight_Class_Layak, $Result_Deviasi_Weight_Class_Layak);
        $Result_Gaussian_Weight_Class_Tidak_Layak = $this->getResultDistribusi_Gaussian($Weight_Value, $Result_Mean_Weight_Class_Tidak_Layak, $Result_Deviasi_Weight_Class_Tidak_Layak);
        
        /*================================================================================================================================================================================================================================================= */
        
        /* Attribute Age */
        
        $Value_Age_Class_Layak = $this->getJumlahValue_EachAttribute('Layak', 'Age');
        $Value_Age_Class_Tidak_Layak = $this->getJumlahValue_EachAttribute('Tidak Layak', 'Age');
        
        $Result_Mean_Age_Class_Layak = $this->getMeanResult_EachClass($Value_Age_Class_Layak, $Data_Class_Layak);
        $Result_Mean_Age_Class_Tidak_Layak = $this->getMeanResult_EachClass($Value_Age_Class_Tidak_Layak, $Data_Class_Tidak_Layak);
        
        $Result_Deviasi_Age_Class_Layak = $this->getResultAttribute_Deviasi_EachClass('Layak', 'Age', $Result_Mean_Age_Class_Layak, $Data_Class_Layak);
        $Result_Deviasi_Age_Class_Tidak_Layak = $this->getResultAttribute_Deviasi_EachClass('Tidak Layak', 'Age', $Result_Mean_Age_Class_Tidak_Layak, $Data_Class_Tidak_Layak);
        
        $Result_Gaussian_Age_Layak = $this->getResultDistribusi_Gaussian($Age_Value, $Result_Mean_Age_Class_Layak, $Result_Deviasi_Age_Class_Layak);
        $Result_Gaussian_Age_Tidak_Layak = $this->getResultDistribusi_Gaussian($Age_Value, $Result_Mean_Age_Class_Tidak_Layak, $Result_Deviasi_Age_Class_Tidak_Layak);
        /*================================================================================================================================================================================================================================================= */
        
        /* Probabilitas Class */
        $Result_Gaussian_All_Attribute_Class_Layak = [$Result_Gaussian_Hemoglobin_Class_Layak, 
        $Result_Gaussian_Sistole_Class_Layak,
        $Result_Gaussian_Diastole_Class_Layak,
        $Result_Gaussian_Weight_Class_Layak,
        $Result_Gaussian_Age_Layak];
        
        $Result_Gaussian_All_Attribute_Class_Tidak_Layak = [$Result_Gaussian_Hemoglobin_Class_Tidak_Layak,
        $Result_Gaussian_Sistole_Class_Tidak_Layak,
        $Result_Gaussian_Diastole_Class_Tidak_Layak,
        $Result_Gaussian_Weight_Class_Tidak_Layak,
        $Result_Gaussian_Age_Tidak_Layak];
        
        $Result_Probability_Class_Layak = $this->getProbability_EachClass($Result_Gaussian_All_Attribute_Class_Layak);
        $Result_Probability_Class_Tidak_Layak = $this->getProbability_EachClass($Result_Gaussian_All_Attribute_Class_Tidak_Layak);
        
        /*================================================================================================================================================================================================================================================= */
        
        /* Probabilitas Final Class */
        $Probability_Final_Layak = $this->getFinalProbability_EachClass($Result_Probability_Class_Layak, $Result_Prior_Prob_Layak);
        $probability_Final_Tidak_Layak = $this->getFinalProbability_EachClass($Result_Probability_Class_Tidak_Layak, $Result_Prior_Prob_Tidak_Layak);

 

        
        $Result_Normalization_Layak = $this->getNormalizationProbability_EachClass($Probability_Final_Layak, $probability_Final_Tidak_Layak);
        $Result_Normalization_Tidak_Layak = $this->getNormalizationProbability_EachClass($probability_Final_Tidak_Layak, $Probability_Final_Layak);

        // dd($Result_Normalization_Layak, $Result_Normalization_Tidak_Layak);

        if($Result_Normalization_Layak > $Result_Normalization_Tidak_Layak){
            return 'Layak';
        }else{
            return 'Tidak Layak';
        }
    }    
}
