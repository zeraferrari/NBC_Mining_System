<?php

namespace App\Http\Controllers;

use App\Models\DataTraining;
use App\Models\RhesusCategory;
use App\Models\TransactionDonor;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TransactionDonorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data_transaction_user = DB::table('transaction_donors')
        // ->join('users', 'transaction_donors.User_Pendonor_id', '=', 'users.id')
        // ->join('rhesus_categories', 'users.Rhesus_id', '=', 'rhesus_categories.id', 'left outer')
        // ->where('Status_Donor', '=', 'Belum Mendonor')
        // // ->select('users.name as Nama_user', 'users.NIK as NIK', 'rhesus_categories.Name as Rhesus_Darah', 'users.Status_Donor as Status_Donor')
        // ->get();
        
        // $data_transaction_user = TransactionDonor::select('transaction_donors.id as transaction_id', 'users.name as users_name', 'NIK', 'rhesus_categories.Name as Rhesus', 'Status_Donor')
        // ->join('users', 'transaction_donors.User_Pendonor_id', '=', 'users.id')
        // ->join('rhesus_categories', 'users.Rhesus_id', '=', 'rhesus_categories.id', 'left outer')
        // ->where('Status_Donor', '=', 'Belum Mendonor')
        // ->get();

        $data_transaction_user = TransactionDonor::with('User_Connection.Rhesus_Connection')->get();
        return view('TransactionDonor.index', compact('data_transaction_user'));
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
        $input = $request->all();
        $validate = Validator::make($input, [
            'Code_Transaction' => 'nullable',
            'Age'   =>  'nullable',
            'Weight' => 'nullable',
            'Hemoglobin' => 'nullable',
            'Pressure_sistole' => 'nullable',
            'Pressure_distole' => 'nullable',
            'Kembali_Donor' => 'nullable',
            'Status_Transaction' => 'nullable',
            'User_PMI_id' => 'nullable'
        ]);
        $has_valid = $validate->validated();
        $has_valid['User_Pendonor_id'] = Auth::id();
        $has_valid['Waktu_Donor'] = Carbon::now();
        $data = TransactionDonor::create($has_valid);
        return redirect()->route('transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransactionDonor  $transactionDonor
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionDonor $transactionDonor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransactionDonor  $transactionDonor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction_data = TransactionDonor::with('User_Connection.Rhesus_Connection')->find($id);
        $user_data = User::all();
        $rhesus_data = RhesusCategory::all();

        // dd(($transaction_data->User_Connection->Rhesus_Connection->Name ?? '') === $rhesus_data->first()->Name ? 'Selected' : '', $rhesus_data);
        // dd('testing');

        return view('TransactionDonor.edit', compact('transaction_data', 'user_data', 'rhesus_data'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransactionDonor  $transactionDonor
     * @return \Illuminate\Http\Response
     */

    public function test(){
        $data= DataTraining::where('Status', 'Layak')->count();
        return $data;
    }

    public function test_2(){
        $data = DataTraining::where('Status', 'Layak')->sum('Hemoglobin');
        return $data;
    }

    public function update(Request $request, $id)
    {
        /* Hitung Jumlah Class (Layak, Tidak) Data Training */
        $total_data_all_training = DataTraining::count(); //Get total data training
        $total_data_layak_training = DataTraining::where('Status', 'Layak')->count(); //Get total data layak
        $total_data_tidak_layak_training = DataTraining::where('Status', 'Tidak Layak')->count(); //Get total data tidak layak
        $eksponensial = 2.71828183;
        $vi = 3.14;
        //////////////////////////////////

        /*Probabilitas Hipotesis Class Layak */
        $probabilitas_Hipo_Layak = $total_data_layak_training/$total_data_all_training; //Get Probabilitas Hipotesis Layak
        /* */

        /*Probabilitas Hipotesis Class Tidak Layak */
        $probabilitas_Hipo_Tidak_Layak = $total_data_tidak_layak_training/$total_data_all_training; //Get Probabilitas Hipotesis Tidak Layak
        /* */

    //Attribute Hemoglobin
       $att_hemo_Layak = DataTraining::where('Status', 'Layak')->sum('Hemoglobin');
       $att_hemo_Tidak_Layak = DataTraining::where('Status', 'Tidak Layak')->sum('Hemoglobin');

       $mean_hemo_Layak = $att_hemo_Layak/$total_data_layak_training; //Mean Hemoglobin Kondisi Layak
       $mean_hemo_Tidak_Layak = $att_hemo_Tidak_Layak/$total_data_tidak_layak_training; //Mean Hemoglobin Kondisi Tidak Layak

    /* Perhitungan Standar Deviasi Class Layak */
       $hemo_value_Layak = DataTraining::where('Status', 'Layak')->pluck('Hemoglobin');
       $temp = array();

       foreach ($hemo_value_Layak as $datas => $value) {
           $result_Hemo_Layak = pow(($hemo_value_Layak[$datas] - $mean_hemo_Layak),2);
           $temp[] = $result_Hemo_Layak;
        }       
          $standar_dev_Hemo_Layak = sqrt(array_sum($temp)/($total_data_layak_training-1));
    ///////////////////

    /* Perhitungan Standar Deviasi Class Tidak Layak */
    
       $hemo_value_Tidak_Layak = DataTraining::where('Status', 'Tidak Layak')->pluck('Hemoglobin');
       $temp_2 = array();
       foreach ($hemo_value_Tidak_Layak as $datas => $value) {
           $result_Hemo_Tidak_Layak = pow(($hemo_value_Tidak_Layak[$datas] - $mean_hemo_Tidak_Layak),2);
           $temp_2[] = $result_Hemo_Tidak_Layak;
       }
    
       $standar_dev_hemo_Tidak_Layak = sqrt(array_sum($temp_2)/($total_data_tidak_layak_training-1));
    //////////////////
    
       $gausian_Layak_Result = 1/(sqrt(2*$vi)*$standar_dev_Hemo_Layak)*pow($eksponensial, - pow(80-$mean_hemo_Layak, 2)/(2*pow($standar_dev_Hemo_Layak, 2)));
       $gausian_Tidak_Layak_Result = 1/(sqrt(2*$vi)*$standar_dev_hemo_Tidak_Layak)*pow($eksponensial, - pow(80-$mean_hemo_Tidak_Layak, 2)/(2*pow($standar_dev_hemo_Tidak_Layak, 2)));
       
       

       dd($gausian_Layak_Result, 
       $gausian_Tidak_Layak_Result);

    // 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransactionDonor  $transactionDonor
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionDonor $transactionDonor)
    {
        //
    }

    public function getMeanHemoglobinResult_Layak(){
        $naive_bayes = new CalculationNaiveBayesController;
        
        $total_data_training = $naive_bayes->getTotalDataTraining();
        $total_layak = $naive_bayes->getTotal_EachClass('Layak');
        $total_tidak_layak = $naive_bayes->getTotal_EachClass('Tidak Layak');
        $result_prior_layak = $naive_bayes->GetResult_EachPriorProbabilityClass($total_layak, $total_data_training);
        $result_prior_tidak_layak = $naive_bayes->GetResult_EachPriorProbabilityClass($total_tidak_layak, $total_data_training);
        
        
        $calculation_all_hemoglobin_layak = $naive_bayes->getJumlahValue_EachAttribute('Layak', 'Hemoglobin');
        $calculation_all_hemoglobin_tidak_layak = $naive_bayes->getJumlahValue_EachAttribute('Tidak Layak', 'Hemoglobin');


        
        $calculation_mean_hemoglobin_layak = $naive_bayes->getMeanResult_EachClass($calculation_all_hemoglobin_layak, $total_layak);
        $calculation_mean_hemoglobin_tidak_layak = $naive_bayes->getMeanResult_EachClass($calculation_all_hemoglobin_tidak_layak, $total_tidak_layak);

        $deviasi_hemo_layak = $naive_bayes->getResultAttribute_Deviasi_EachClass('Layak', 'Hemoglobin', $calculation_mean_hemoglobin_layak, $total_layak);
        $deviasi_hemo_tidak_layak = $naive_bayes->getResultAttribute_Deviasi_EachClass('Tidak Layak', 'Hemoglobin', $calculation_mean_hemoglobin_tidak_layak, $total_tidak_layak);

        $result_gaussian_hemo_layak = $naive_bayes->getResultDistribusi_Gaussian(12.5, $calculation_mean_hemoglobin_layak, $deviasi_hemo_layak);
        $result_gaussian_hemo_tidak_layak = $naive_bayes->getResultDistribusi_Gaussian(12.5, $calculation_mean_hemoglobin_tidak_layak, $deviasi_hemo_tidak_layak);
        
        echo "Total Data Training = ".$total_data_training."<br></br>";
        echo "Total Data Class Layak = ".$total_layak."<br></br>";
        echo "Total Data Class Tidak Layak = ".$total_tidak_layak."<br></br>";
        echo "Prior Layak = ".$result_prior_layak."<br></br>";
        echo "Prior Tidak Layak = ".$result_prior_tidak_layak."<br></br>";
        echo "Total Prior = ".$result_prior_layak+$result_prior_tidak_layak."<br></br>";
        echo "Penjumlahan Data Hemo Layak = ".$calculation_all_hemoglobin_layak."<br></br>";
        echo "Penjumlahan Data Hemo Tidak Layak = ".$calculation_all_hemoglobin_tidak_layak."<br></br>";
        echo "Hasil Mean Hemo Layak = ".$calculation_mean_hemoglobin_layak."<br></br>";
        echo "Hasil Mean Hemo Tidak Layak = ".$calculation_mean_hemoglobin_tidak_layak."<br></br>";
        echo "Hasil Deviasi Hemo Layak = ".$deviasi_hemo_layak."<br></br>";
        echo "Hasil Deviasi Hemo Tidak Layak = ".$deviasi_hemo_tidak_layak."<br></br>";
        echo "Hasil Gaussian Hemo Layak = ".$result_gaussian_hemo_layak."<br></br>";
        echo "Hasil Gaussian Hemo Tidak Layak = ".$result_gaussian_hemo_tidak_layak."<br></br>";
    }
}
