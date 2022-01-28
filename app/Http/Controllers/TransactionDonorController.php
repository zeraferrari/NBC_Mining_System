<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionUpdateValidation;
use App\Models\RhesusCategory;
use App\Models\TransactionDonor;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class TransactionDonorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_transaction_user = TransactionDonor::with('User_Connection.Rhesus_Connection')->where('Status_Donor', '=', 'Medical Check')->latest()->get();
        return view('TransactionDonor.index', compact('data_transaction_user'));
    }
    

    public function generatedNumberCode($lengthCharacter){
        $result = '';

        for($i = 0; $i < $lengthCharacter; $i++){
            $result .= rand(0, 9);
        }
        return $result;
    }

    public function GeneratedTransactionCode(){
        $dateNow = Carbon::now('Asia/Makassar')->format('d-m-Y');
        $dateNow = str_replace('-', '', $dateNow);
        $random_code = $this->generatedNumberCode(5);
        if(Auth::user()->Rhesus_id == NULL){
                $code_rhesus = 9;
                $Code_Transaction = TransactionDonor::doesntHave('User_Connection.Rhesus_Connection')
                ->where('Waktu_Donor', '=', today('Asia/Makassar'))
                ->count(); 
        }else{
                $code_rhesus = Auth::user()->Rhesus_id;
                $Code_Transaction = TransactionDonor::whereHas('User_Connection.Rhesus_Connection',
                function($query){
                    $get_name_rhesus = Auth::user()->Rhesus_Connection->Name;
                    $query->where('rhesus_categories.Name', '=', $get_name_rhesus)
                            ->where('Waktu_Donor', '=', today('Asia/Makassar'));
                })->count();
        }
        $generated_new_code = str_pad($Code_Transaction+1, 5, 0, STR_PAD_LEFT);
        $temp = array('TB-',$dateNow, $code_rhesus, $random_code, $generated_new_code);
        $merge_code = implode('', $temp);
        return $merge_code;
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
            'Code_Transaction' => 'required',
            'Age'   =>  'nullable',
            'Weight' => 'nullable',
            'Hemoglobin' => 'nullable',
            'Pressure_sistole' => 'nullable',
            'Pressure_distole' => 'nullable',
            'Kembali_Donor' => 'nullable',
            'Status_Transaction' => 'nullable',
            'Status_Donor' => 'required',
            'User_PMI_id' => 'nullable'
        ]);
        $has_valid = $validate->validated();
        $has_valid['Code_Transaction'] = $this->GeneratedTransactionCode();
        $has_valid['User_Pendonor_id'] = Auth::id();
        $has_valid['Waktu_Donor'] = Carbon::now('Asia/Makassar');
        $has_valid['Status_Donor'] = 'Medical Check';
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
        return view('TransactionDonor.edit', compact('transaction_data', 'user_data', 'rhesus_data'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransactionDonor  $transactionDonor
     * @return \Illuminate\Http\Response
     */

    public function update(TransactionUpdateValidation $request, $id)
    {
        $naive_bayes = new CalculationNaiveBayesController();
        $result = $naive_bayes->Calculation_Naive_Bayes($request->Hemoglobin,
                                                    $request->Pressure_sistole,
                                                    $request->Pressure_diastole,
                                                            $request->Weight,
                                                              $request->Age);
        
        $data_has_been_validate = $request->validated();
        $data_has_been_validate['User_PM_id'] = Auth::id();
        $data = TransactionDonor::find($id);
        if($result === 'Layak'){
            $data_has_been_validate['Status_Transaction'] = $result;
            $data_has_been_validate['Status_Donor'] = 'Berhasil Mendonor';
            $data_has_been_validate['Kembali_Donor'] = Carbon::now('Asia/Makassar')->addMonth(2);
            $data->update($data_has_been_validate);
            $data->User_Connection->update(['Rhesus_id' => $data_has_been_validate['Rhesus_category'], 'Status_Donor' => 'Sudah Mendonor']);   
        }else{
            $data_has_been_validate['Status_Transaction'] = $result;
            $data_has_been_validate['Status_Donor'] = 'Gagal Donor';
            $data_has_been_validate['Kembali_Donor'] = Carbon::now('Asia/Makassar')->addWeek(1);
            $data->update($data_has_been_validate);
            $data->User_Connection->update(['Rhesus_id' => $data_has_been_validate['Rhesus_category'], 'Status_Donor' => 'Belum Mendonor']);   
        }
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

    
}
