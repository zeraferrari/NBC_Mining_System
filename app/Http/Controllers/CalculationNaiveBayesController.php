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
        $the_calculation_result = round(($CalculationEachClass/$TotalDataTraining), 3);
        return $the_calculation_result;
    }

    public function getJumlahValue_EachAttribute($Class,$attribute){
        $query = DataTraining::where('Status', $Class)->sum($attribute);
        return $query;
    }


    public function getMeanResult_EachClass($Attribute, $TotalClass){
        $the_calculation_result = $Attribute/$TotalClass;
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
        $Calculation_Gaussian = 1/(sqrt(2*$this->vi) * $deviasi_result) * (pow($this->eksponensial, - pow(($incoming_input-$mean_result),2)/2*pow($deviasi_result, 2)));
        return $Calculation_Gaussian;
    }
}
