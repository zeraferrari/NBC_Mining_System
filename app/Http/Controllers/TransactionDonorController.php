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
    protected $title = 'Manajement Antrian Donor Darah';
    public function index(){
        $data_transaction_user = TransactionDonor::with('User_Connection.Rhesus_Connection')
                                    ->where('Status_Donor', '=', 'Medical Check')
                                    ->oldest()->get();
        $title = $this->title;
        return view('Manajement.Antrian.index', compact('data_transaction_user', 'title'));
        
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
        TransactionDonor::create($has_valid);
        return redirect()->route('Antrian.Mendonor');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransactionDonor  $transactionDonor
     * @return \Illuminate\Http\Response
     */

    public function getSuccess_transaction_user($id_user_pendonor){
        $data_success_transaction_user = TransactionDonor::all()
                                            ->where('Status_Donor', '=', 'Berhasil Mendonor')
                                            ->where('User_Pendonor_id', '=', $id_user_pendonor)
                                            ->count();
        return $data_success_transaction_user;
    }

    public function getFails_transaction_user($id_user_pendonor){
        $data_fails_transaction_user = TransactionDonor::all()
                                            ->where('Status_Donor', '=', 'Gagal Donor')
                                            ->where('User_Pendonor_id', '=', $id_user_pendonor)
                                            ->count();
        return $data_fails_transaction_user;
    }


    public function edit($id)
    {
        $title = $this->title;
        $transaction_data = TransactionDonor::with('User_Connection.Rhesus_Connection')->find($id);
        $data_success_transaction_user = $this->getSuccess_transaction_user($transaction_data->User_Pendonor_id);
        
        $data_fails_transaction_user = $this->getFails_transaction_user($transaction_data->User_Pendonor_id);
        
        $total_data_transaction_user = $data_success_transaction_user + $data_fails_transaction_user;
        $history_transaction_user = TransactionDonor::with('Petugas_Connection')->get()
                                                        ->whereIn('Status_Donor', ['Berhasil Mendonor', 'Gagal Donor'])
                                                        ->where('User_Pendonor_id', '=', $transaction_data->User_Pendonor_id)
                                                        ->sortBy('Waktu_Donor', SORT_REGULAR, true);

                
        $rhesus_data = RhesusCategory::all();
        return view('Manajement.Antrian.edit', compact('transaction_data', 
                                                                            'rhesus_data',
                                                                            'title',
                                                                            'data_success_transaction_user',
                                                                            'data_fails_transaction_user', 
                                                                            'total_data_transaction_user', 
                                                                            'history_transaction_user'));
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
            $data->User_Connection->update(['Rhesus_id' => $data_has_been_validate['Rhesus_Categories'], 'Status_Donor' => 'Sudah Mendonor']);   
        }else{
            $data_has_been_validate['Status_Transaction'] = $result;
            $data_has_been_validate['Status_Donor'] = 'Gagal Donor';
            $data_has_been_validate['Kembali_Donor'] = Carbon::now('Asia/Makassar')->addWeek(1);
            $data->update($data_has_been_validate);
            $data->User_Connection->update(['Rhesus_id' => $data_has_been_validate['Rhesus_Categories'], 'Status_Donor' => 'Belum Mendonor']);   
        }
        return redirect()->route('Manajement.Transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransactionDonor  $transactionDonor
     * @return \Illuminate\Http\Response
     */

    public function GetResult_Transaction_Donor(){
        $title = 'Manajement Hasil Transaksi Donor';
        $result_transaction = TransactionDonor::with(['User_Connection', 'Petugas_Connection'])->latest()->get()
                                                ->whereIn('Status_Donor', ['Berhasil Mendonor', 'Gagal Donor']);
        return view('Manajement.HasilTransaksiDonor.index', compact('title',
                                                                                    'result_transaction'));
    }
    
    public function GetDetail_Transaction_Donor(TransactionDonor $TransactionDonor){
        $title = 'Manajement Hasil Transaksi Donor';
        $detail_transaction = $TransactionDonor;
        $data_success_transactions_user = $this->getSuccess_transaction_user($TransactionDonor->User_Pendonor_id);
        $data_fails_transactions_user = $this->getFails_transaction_user($TransactionDonor->User_Pendonor_id);
        $total_transactions_user = $data_success_transactions_user + $data_fails_transactions_user;
        return view('Manajement.HasilTransaksiDonor.show', compact('title',
                                                                                'detail_transaction',
                                                                                'data_success_transactions_user',
                                                                                'data_fails_transactions_user',
                                                                                'total_transactions_user'));
    }
}
