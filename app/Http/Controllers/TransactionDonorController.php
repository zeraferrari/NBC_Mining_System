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
use Barryvdh\DomPDF\Facade\PDF;
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
        $this->middleware('auth');
        $data_transaction_user = TransactionDonor::with('User_Connection.Rhesus_Connection')
                                    ->where('Status_Donor', '=', 'Medical Check')
                                    ->oldest()->get();
        $title = $this->title;
        $Navigator = new HomeController;
        $latest_inbox = $Navigator->GetLatestInbox();
        $latest_notification = $Navigator->GetLatestNotification();
        
        return view('Manajement.Antrian.index', compact('data_transaction_user', 'title', 'latest_inbox', 'latest_notification'));
        
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
        $now = Carbon::now()->isoFormat('YYYY-MM-DD');
        if(Auth::check()){
            if(Auth::user()->roles[0]->name == 'Petugas Medis' || Auth::user()->roles[0]->name == 'Pendonor'){
                if(Auth::user()->Status_Donor == 'Belum Mendonor'){
                    if(TransactionDonor::where('User_Pendonor_id', '=', Auth::user()->id)->latest()->pluck('Status_Donor')->first() == 'Medical Check'){
                        return redirect()->route('home')->with('response_check_queue_transaction', 'Kamu masih dalam melakukan transaksi donor darah, Silahkan pergi ke PMI terdekat untuk melakukan medical check donor darah ');
                    }elseif(TransactionDonor::where('User_Pendonor_id', '=', Auth::user()->id)->latest()->pluck('Status_Donor')->first() == 'Gagal Donor'){
                        if($now >= TransactionDonor::where('User_Pendonor_id', '=', Auth::user()->id)->latest()->pluck('Kembali_Donor')->first()){
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
                            return redirect()->back()->with('response_success_request_transaction','Selamat, kamu sudah masuk dalam list transaksi donor darah. Silahkan ke PMI terdekat untuk melakukan medical check donor darah');
                        }else{
                            $Date_Donor_User = TransactionDonor::where('User_Pendonor_id', '=', Auth::user()->id)->latest()->first();
                            $date = Carbon::parse($Date_Donor_User->Kembali_Donor)->locale('id')->isoFormat('dddd, D-MMMM-Y');
                            return redirect()->route('home')->with('response_failed_donor_transaction', 'Mohon maaf transaksi terakhir donor kamu gagal, Silahkan kembali donor darah pada tanggal <b>'.$date.'</b>');
                        }
                    }
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
                    return redirect()->back()->with('response_success_request_transaction','Selamat, kamu sudah masuk dalam list transaksi donor darah. Silahkan ke PMI terdekat untuk melakukan medical check donor darah');
                }else{
                    $Date_Donor_User = TransactionDonor::where('User_Pendonor_id', '=', Auth::user()->id)->latest()->first();
                    $date = Carbon::parse($Date_Donor_User->Kembali_Donor)->locale('id')->isoFormat('dddd, D-MMMM-Y');
                    return redirect()->route('home')->with('response_check_status_donor', 'Mohon maaf, waktu donor kamu belum saatnya. Silahkan mendonor pada tanggal <b>'.$date.'</b>');
                }
            }
        }else{
            return redirect()->route('home')->with('response_login', 'Mohon maaf, kamu harus login dahulu sebelum melakukan transaksi yah 😁 ');
        }                         
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


    public function edit(TransactionDonor $TransactionDonor)
    {
        $title = $this->title;
        $data_success_transaction_user = $this->getSuccess_transaction_user($TransactionDonor->User_Pendonor_id);
        
        $data_fails_transaction_user = $this->getFails_transaction_user($TransactionDonor->User_Pendonor_id);
        
        $total_data_transaction_user = $data_success_transaction_user + $data_fails_transaction_user;
        $history_transaction_user = TransactionDonor::with('Petugas_Connection')->get()
                                                        ->whereIn('Status_Donor', ['Berhasil Mendonor', 'Gagal Donor'])
                                                        ->where('User_Pendonor_id', '=', $TransactionDonor->User_Pendonor_id)
                                                        ->sortBy('Waktu_Donor', SORT_REGULAR, true);

                
        $rhesus_data = RhesusCategory::all();
        $Navigator = new HomeController;
        $latest_inbox = $Navigator->GetLatestInbox();
        $latest_notification = $Navigator->GetLatestNotification();
        return view('Manajement.Antrian.edit', compact('TransactionDonor', 
                                                                            'rhesus_data',
                                                                            'title',
                                                                            'data_success_transaction_user',
                                                                            'data_fails_transaction_user', 
                                                                            'total_data_transaction_user', 
                                                                            'history_transaction_user', 'latest_inbox', 'latest_notification'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransactionDonor  $transactionDonor
     * @return \Illuminate\Http\Response
     */

    public function update(TransactionUpdateValidation $request, TransactionDonor $TransactionDonor)
    {
        $naive_bayes = new CalculationNaiveBayesController();
        $result = $naive_bayes->Classifier_Naive_Bayes(
            $request->Age,
            $request->Weight,
            $request->Hemoglobin,
            $request->Pressure_sistole,
            $request->Pressure_diastole
        );
        
        $data_has_been_validate = $request->validated();

        $data_has_been_validate['User_PM_id'] = Auth::id();
        if($result[0]->Result_Classification === 'Layak'){
            $data_has_been_validate['Status_Transaction'] = $result[0]->Result_Classification;
            $data_has_been_validate['Status_Donor'] = 'Berhasil Mendonor';
            $data_has_been_validate['Kembali_Donor'] = Carbon::now('Asia/Makassar')->addMonth(2);
            $TransactionDonor->update($data_has_been_validate);
            $TransactionDonor->User_Connection->update(['Rhesus_id' => $data_has_been_validate['Rhesus_Categories'], 'Status_Donor' => 'Sudah Mendonor']);   
        }else{
            $data_has_been_validate['Status_Transaction'] = $result[0]->Result_Classification;
            $data_has_been_validate['Status_Donor'] = 'Gagal Donor';
            $data_has_been_validate['Kembali_Donor'] = Carbon::now('Asia/Makassar')->addWeek(1);
            $TransactionDonor->update($data_has_been_validate);
            $TransactionDonor->User_Connection->update(['Rhesus_id' => $data_has_been_validate['Rhesus_Categories'], 'Status_Donor' => 'Belum Mendonor']);   
        }
        return redirect()->route('Manajement.Transaction.index')->with('success_transaction', 'Transaksi dengan nomor kode : <b>'.$TransactionDonor->Code_Transaction.'</b> telah selesai !');
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
                                                ->whereIn('Status_Donor', ['Berhasil Mendonor', 'Gagal Donor'])
                                                ->sortByDesc('Waktu_Donor');
        $Navigator = new HomeController;
        $latest_inbox = $Navigator->GetLatestInbox();
        $latest_notification = $Navigator->GetLatestNotification();
        return view('Manajement.HasilTransaksiDonor.index', compact('title',
                                                                                    'result_transaction', 'latest_inbox', 'latest_notification'));
    }
    
    public function GetDetail_Transaction_Donor(TransactionDonor $TransactionDonor){
        $title = 'Manajement Hasil Transaksi Donor';
        $detail_transaction = $TransactionDonor::with('User_Connection.Rhesus_Connection')
                                ->where('Code_Transaction', '=', $TransactionDonor->Code_Transaction)
                                ->firstOrFail();
        $data_success_transactions_user = $this->getSuccess_transaction_user($TransactionDonor->User_Pendonor_id);
        $data_fails_transactions_user = $this->getFails_transaction_user($TransactionDonor->User_Pendonor_id);
        $total_transactions_user = $data_success_transactions_user + $data_fails_transactions_user;

        $naive_bayes_classifier = new CalculationNaiveBayesController();
        $Result_Classifier = $naive_bayes_classifier->Classifier_Naive_Bayes(
            $TransactionDonor->Age,
            $TransactionDonor->Weight,
            $TransactionDonor->Hemoglobin,
            $TransactionDonor->Pressure_sistole,
            $TransactionDonor->Pressure_diastole
        );
        
        $Navigator = new HomeController;
        $latest_inbox = $Navigator->GetLatestInbox();
        $latest_notification = $Navigator->GetLatestNotification();


        return view('Manajement.HasilTransaksiDonor.show', compact('title',
                                                                                'detail_transaction',
                                                                                'data_success_transactions_user',
                                                                                'data_fails_transactions_user',
                                                                                'total_transactions_user', 'Result_Classifier',
                                                                                'latest_inbox', 'latest_notification'));
    }

    public function Printout(TransactionDonor $TransactionDonor){
        $data = $TransactionDonor::with('User_Connection.Rhesus_Connection')
                ->where('Code_Transaction', '=', $TransactionDonor->Code_Transaction)->firstOrFail();
        $Waktu_Donor = Carbon::parse($data->Waktu_Donor)->isoFormat('dddd DD MMMM YYYY');
        
        $naive_bayes = new CalculationNaiveBayesController;
        $Result_Classifier = $naive_bayes->Classifier_Naive_Bayes($TransactionDonor->Age, $TransactionDonor->Weight, $TransactionDonor->Hemoglobin,
        $TransactionDonor->Pressure_sistole, $TransactionDonor->Pressure_diastole);
        return view('Manajement.HasilTransaksiDonor.Printout', compact('data', 'Waktu_Donor', 'Result_Classifier'));
    }
}
