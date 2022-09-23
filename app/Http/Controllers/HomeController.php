<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests\AccountSettingValidation;
use App\Http\Requests\HomeValidation;
use App\Models\RhesusCategory;
use App\Models\TransactionDonor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function GetLatestInbox(){
        if(Auth::guest()){
            $latest_inbox = [];
            return $latest_inbox;
        }elseif(Auth::user()->roles[0]->name === 'Administrator'){
            $latest_inbox = TransactionDonor::with('User_Connection.Rhesus_Connection')->latest()->take(5)->get();
            return $latest_inbox;
        }else{
            $latest_inbox = TransactionDonor::with('User_Connection.Rhesus_Connection')
            ->where('User_Pendonor_id', '=', Auth()->User()->id)
            ->whereNotIn('Status_Donor', ['Medical Check'])
            ->latest()->take(5)->get();
            return $latest_inbox;
        }
    }

    public function GetLatestNotification(){
        if(Auth::guest()){
            $latest_notification = [];
            return $latest_notification;
        }
        elseif(Auth::User()->roles[0]->name === 'Pendonor'){
            $latest_notification = TransactionDonor::with('User_Connection.Rhesus_Connection')
            ->where('User_Pendonor_id', '=', Auth::User()->id)
            ->latest()->take(5)->get();
            return $latest_notification;
        }elseif(Auth::User()->roles[0]->name === 'Petugas Medis'){
            $latest_notification = TransactionDonor::with('User_Connection.Rhesus_Connection')
            ->where('User_PM_id', '=', Auth::User()->id)
            ->latest()->take(5)->get();
            return $latest_notification;
        }elseif(Auth::User()->roles[0]->name === 'Administrator'){
            $latest_notification = TransactionDonor::with('User_Connection.Rhesus_Connection')
            ->whereNotIn('Status_Donor', ['Medical Check'])
            ->latest()->take(5)->get();
            return $latest_notification;
        }
    }

    public function Statistic_Blood(){
        $data_rhesus = RhesusCategory::with('User_Connection.Transaction_Connect')->get();
        $datasets_today_blood = [];
        foreach($data_rhesus as $each_data){
            array_push($datasets_today_blood, (object)[
                'Name_Rhesus'   => $each_data->Name,
                'Data_Success_Donor' => 0,
                'Data_Failed_Donor' => 0,
            ]);
        }

        $transaction_today = TransactionDonor::with('User_Connection.Rhesus_Connection')
        ->where('created_at', '>=', \Carbon\Carbon::now()->isoFormat('YYYY-MM-DD').' 00:00:00')
        ->where('created_at', '<=', \Carbon\Carbon::now()->isoFormat('YYYY-MM-DD').' 23:59:59')
        ->whereIn('Status_Donor', ['Berhasil Mendonor', 'Gagal Donor'])
        ->get();

        foreach($data_rhesus as $index => $value){
            $count_success_transaction = 0;
            $count_failed_transaction = 0;
            foreach($transaction_today as $key => $value){
                if($transaction_today[$key]->User_Connection->Rhesus_Connection->id === $data_rhesus[$index]->id){
                    if($transaction_today[$key]->Status_Donor == 'Berhasil Mendonor'){
                        $count_success_transaction++;
                    }elseif($transaction_today[$key]->Status_Donor == 'Gagal Donor'){
                        $count_failed_transaction++;
                    }
                }
            }
            if($datasets_today_blood[$index]->Name_Rhesus === $data_rhesus[$index]->Name){
                if($datasets_today_blood[$index]->Name_Rhesus === 'A+'){
                    $datasets_today_blood[$index]->Data_Success_Donor = $count_success_transaction;
                    $datasets_today_blood[$index]->Data_Failed_Donor = $count_failed_transaction;
                }
                elseif($datasets_today_blood[$index]->Name_Rhesus === 'A-'){
                    $datasets_today_blood[$index]->Data_Success_Donor = $count_success_transaction;
                    $datasets_today_blood[$index]->Data_Failed_Donor = $count_failed_transaction;
                }
                elseif($datasets_today_blood[$index]->Name_Rhesus === 'B+'){
                    $datasets_today_blood[$index]->Data_Success_Donor = $count_success_transaction;
                    $datasets_today_blood[$index]->Data_Failed_Donor = $count_failed_transaction;
                }
                elseif($datasets_today_blood[$index]->Name_Rhesus === 'B-'){
                    $datasets_today_blood[$index]->Data_Success_Donor = $count_success_transaction;
                    $datasets_today_blood[$index]->Data_Failed_Donor = $count_failed_transaction;
                }
                elseif($datasets_today_blood[$index]->Name_Rhesus === 'O+'){
                    $datasets_today_blood[$index]->Data_Success_Donor = $count_success_transaction;
                    $datasets_today_blood[$index]->Data_Failed_Donor = $count_failed_transaction;
                }
                elseif($datasets_today_blood[$index]->Name_Rhesus === 'O-'){
                    $datasets_today_blood[$index]->Data_Success_Donor = $count_success_transaction;
                    $datasets_today_blood[$index]->Data_Failed_Donor = $count_failed_transaction;
                }
                elseif($datasets_today_blood[$index]->Name_Rhesus === 'AB+'){
                    $datasets_today_blood[$index]->Data_Success_Donor = $count_success_transaction;
                    $datasets_today_blood[$index]->Data_Failed_Donor = $count_failed_transaction;
                }
                elseif($datasets_today_blood[$index]->Name_Rhesus === 'AB-'){
                    $datasets_today_blood[$index]->Data_Success_Donor = $count_success_transaction;
                    $datasets_today_blood[$index]->Data_Failed_Donor = $count_failed_transaction;
                }
            }
        }
        return $datasets_today_blood;
    }

    public function getMonthNameTransaction($FromDate, $ToDate){
        if(isset($FromDate) AND isset($ToDate)){
            $data_month = TransactionDonor::with('User_Connection.Rhesus_Connection')
                            ->where('created_at', '>=', $FromDate.' 00:00:00')
                            ->where('created_at', '<=', $ToDate.' 23:59:59')
                            ->pluck('created_at')
                            ->sortBy('created_at')->toArray();

            $monthTime = array_map(function ($value){
                return strtotime($value);
            }, $data_month);

            sort($monthTime);
            $Month_Name = array_map(function($value){
                return \Carbon\Carbon::parse($value)->isoFormat('MMMM-YYYY');
            },$monthTime);


            $Name_Month = array_values(array_unique($Month_Name));
            return $Name_Month;
            
        }else{
            $data_month = TransactionDonor::with('User_Connection.Rhesus_Connection')
                            ->pluck('created_at')
                            ->sortBy('created_at')->toArray();
            
            $monthTime = array_map(function ($value){
                return strtotime($value);
            }, $data_month);

            sort($monthTime);
            $Month_Name = array_map(function($value){
                return \Carbon\Carbon::parse($value)->isoFormat('MMMM-YYYY');
            },$monthTime);


            $Name_Month = array_values(array_unique($Month_Name));
            return $Name_Month;
        }
    }

    public function getDataLineChartDashboard($FromDate, $ToDate){
        if(isset($FromDate) AND isset($ToDate)){
            $data_transaction = TransactionDonor::with('User_Connection.Rhesus_Connection')->get()
                                ->where('Status_Donor', '=', 'Berhasil Mendonor')
                                ->where('created_at', '>=', $FromDate.' 00:00:00')
                                ->where('created_at', '<=', $ToDate.' 23:59:59')
                                ->sortBy('created_at')
                                ->groupBy(function($val){
                                    return Carbon::parse($val->created_at)->isoFormat('MMMM-YYYY');
                                });
            $data_rhesus = RhesusCategory::all();
            $datasets = [];
            
            foreach($data_rhesus as $each_rhesus){
                array_push($datasets, (object)[
                    'label'  => $each_rhesus->Name,
                    'data'  => [],
                    'BorderColor' => '',
                    'BackgroundColor' => '',
                ]);
            }

            foreach($data_transaction as $all_transaction_each_month){
                foreach($data_rhesus as $key => $value){
                    $count_data_transaction_each_rhesus = 0;
                    foreach($all_transaction_each_month as $each_transaction_month){
                        if($each_transaction_month->User_Connection->Rhesus_id === $data_rhesus[$key]->id){
                            $count_data_transaction_each_rhesus++;
                        }
                    }
                    
                    if($data_rhesus[$key]->Name == $datasets[$key]->label){
                        $datasets[$key]->data[] = $count_data_transaction_each_rhesus;
                        if($datasets[$key]->label == 'A+'){
                            $datasets[$key]->BorderColor = 'rgba(255, 33, 33, 0.5)';
                                $datasets[$key]->BackgroundColor = 'rgba(255, 33, 33, 0.5)';
                        }
                        elseif($datasets[$key]->label == 'A-'){
                            $datasets[$key]->BorderColor = 'rgba(255, 204, 0, 0.5)';
                            $datasets[$key]->BackgroundColor = 'rgba(255, 204, 0, 0.5)';
                        }
                        elseif($datasets[$key]->label == 'B+'){
                            $datasets[$key]->BorderColor = 'rgba(40, 255, 0, 0.5)';
                            $datasets[$key]->BackgroundColor = 'rgba(40, 255, 0, 0.5)';
                        }
                        elseif($datasets[$key]->label == 'B-'){
                            $datasets[$key]->BorderColor = 'rgba(0, 255, 177, 0.5)';
                            $datasets[$key]->BackgroundColor = 'rgba(0, 255, 177, 0.5)';
                        }
                        elseif($datasets[$key]->label == 'O+'){
                            $datasets[$key]->BorderColor = 'rgba(0, 51, 255, 0.5)';
                            $datasets[$key]->BackgroundColor = 'rgba(0, 51, 255, 0.5)';
                        }
                        elseif($datasets[$key]->label == 'O-'){
                            $datasets[$key]->BorderColor = 'rgba(140, 0, 255, 0.5)';
                            $datasets[$key]->BackgroundColor = 'rgba(140, 0, 255, 0.5)';
                        }
                        elseif($datasets[$key]->label == 'AB+'){
                            $datasets[$key]->BorderColor = 'rgba(255, 0, 157, 0.66)';
                            $datasets[$key]->BackgroundColor = 'rgba(255, 0, 157, 0.66)';
                        }
                        elseif($datasets[$key]->label == 'AB-'){
                            $datasets[$key]->BorderColor = 'rgba(0, 78, 255, 0.76)';
                            $datasets[$key]->BackgroundColor = 'rgba(0, 78, 255, 0.76)';
                        }
                    }
                }
            }
            $struct_datasets = json_encode($datasets);
            return $struct_datasets;
        }else{
            $Years = Carbon::now()->format('Y');
            $data_transaction = TransactionDonor::with('User_Connection.Rhesus_Connection')
                                ->where('Status_Donor', '=', 'Berhasil Mendonor')
                                ->where('created_at', 'like', '%'.$Years.'%')->get()
                                ->sortBy('created_at')
                                ->groupBy(function($val){
                                    return Carbon::parse($val->created_at)->isoFormat('MMMM-YYYY');
                                });
            $data_rhesus = RhesusCategory::all();
            $datasets = [];
            
            foreach($data_rhesus as $each_rhesus){
                array_push($datasets, (object)[
                    'label'  => $each_rhesus->Name,
                    'data'  => [],
                    'BorderColor' => '',
                    'BackgroundColor' => '',
                ]);
            }

            foreach($data_transaction as $all_transaction_each_month){
                foreach($data_rhesus as $key => $value){
                    $count_data_transaction_each_rhesus = 0;
                    foreach($all_transaction_each_month as $each_transaction_month){
                        if($each_transaction_month->User_Connection->Rhesus_id == $data_rhesus[$key]->id){
                            $count_data_transaction_each_rhesus++;
                        }
                    }

                    if($data_rhesus[$key]->Name == $datasets[$key]->label){
                        $datasets[$key]->data[] = $count_data_transaction_each_rhesus;
                        if($datasets[$key]->label === 'A+'){
                            $datasets[$key]->BorderColor = 'rgba(255, 33, 33, 0.5)';
                                $datasets[$key]->BackgroundColor = 'rgba(255, 33, 33, 0.5)';
                        }
                        elseif($datasets[$key]->label == 'A-'){
                            $datasets[$key]->BorderColor = 'rgba(255, 204, 0, 0.5)';
                            $datasets[$key]->BackgroundColor = 'rgba(255, 204, 0, 0.5)';
                        }
                        elseif($datasets[$key]->label == 'B+'){
                            $datasets[$key]->BorderColor = 'rgba(40, 255, 0, 0.5)';
                            $datasets[$key]->BackgroundColor = 'rgba(40, 255, 0, 0.5)';
                        }
                        elseif($datasets[$key]->label == 'B-'){
                            $datasets[$key]->BorderColor = 'rgba(0, 255, 177, 0.5)';
                            $datasets[$key]->BackgroundColor = 'rgba(0, 255, 177, 0.5)';
                        }
                        elseif($datasets[$key]->label == 'O+'){
                            $datasets[$key]->BorderColor = 'rgba(0, 51, 255, 0.5)';
                            $datasets[$key]->BackgroundColor = 'rgba(0, 51, 255, 0.5)';
                        }
                        elseif($datasets[$key]->label == 'O-'){
                            $datasets[$key]->BorderColor = 'rgba(140, 0, 255, 0.5)';
                            $datasets[$key]->BackgroundColor = 'rgba(140, 0, 255, 0.5)';
                        }
                        elseif($datasets[$key]->label == 'AB+'){
                            $datasets[$key]->BorderColor = 'rgba(255, 0, 157, 0.66)';
                            $datasets[$key]->BackgroundColor = 'rgba(255, 0, 157, 0.66)';
                        }
                        elseif($datasets[$key]->label == 'AB-'){
                            $datasets[$key]->BorderColor = 'rgba(0, 78, 255, 0.76)';
                            $datasets[$key]->BackgroundColor = 'rgba(0, 78, 255, 0.76)';
                        }
                    }
                }
            }
            // dd($datasets);
            $struct_datasets = json_encode($datasets);
            return $struct_datasets;
        }
    }

    public function index(Request $request)
    {
        $latest_inbox = $this->GetLatestInbox();
        $latest_notification = $this->GetLatestNotification();
        $datasets_today_blood = $this->Statistic_Blood();

        if($request->has('ChartFromData') AND $request->has('ChartToData')){
            $Data_Name_Month = $this->getMonthNameTransaction($request->ChartFromData, $request->ChartToData);
            $Data_Transaction_Each_Month = $this->getDataLineChartDashboard($request->ChartFromData, $request->ChartToData);
            Session()->flashInput($request->input());
            return view('index', compact('latest_inbox', 'latest_notification', 
                                                        'datasets_today_blood', 'Data_Name_Month', 'Data_Transaction_Each_Month'));
        }
        elseif($request->has('Age') OR $request->has('Weight') OR $request->has('Hemoglobin') OR $request->has('Pressure_Sistole') OR $request->has('Pressure_Diastole')){
            if(
                $request->Age >= 17 AND $request->Age <= 65 AND
                $request->Weight >= 45 AND
                $request->Hemoglobin >= 12.5 AND $request->Hemoglobin <= 17 AND
                $request->Pressure_Sistole >= 100 AND $request->Pressure_Sistole <= 170 AND
                $request->Pressure_Diastole >= 70 AND $request->Pressure_Diastole <= 100
            ){
                session()->flash('result', 'Layak untuk mendonorkan darah');
                $request->session()->now('reset_button', 'Reset Button');
            }else{
                if(empty($request->Age) AND empty($request->Weight) AND empty($request->Hemoglobin) AND empty($request->Pressure_Sistole) AND empty($request->Pressure_Diastole)){
                }else{
                    session()->flash('result', 'Tidak layak untuk mendonorkan darah');
                    session()->flashInput($request->input());
                }
            }           
            Validator::make($request->all(), [
                'Age'               =>  ['required', 'integer', 'min:17', 'max:65'],
                'Weight'            => ['required', 'integer', 'min:45'],
                'Hemoglobin'        => ['required', 'numeric', 'min:12.5', 'max:17.0'],
                'Pressure_Sistole'  => ['required', 'integer', 'min:100', 'max:170'],
                'Pressure_Diastole' => ['required', 'integer', 'min:70', 'max:100']
            ], [
                'Age.required'  =>  'Mohon field umur diisi ',
                'Age.integer'   =>  'Field umur hanya menerima inputan angka bulat ',
                'Age.min'       =>  'Nilai umur minimal 17 tahun',
                'Age.max'       =>  'Nilai umur maksimal 65 tahun',

                'Weight.required'  =>  'Mohon field berat badan diisi ',
                'Weight.numeric'   =>  'Field berat badan hanya menerima inputan angka bulat ',
                'Weight.min'       =>   'Nilai berat badan minimal 45 Kg',

                'Hemoglobin.required'  =>  'Mohon field hemoglobin diisi ',
                'Hemoglobin.numeric'   =>  'Field hemoglobin hanya menerima inputan angka ',
                'Hemoglobin.min'       =>  'Nilai hemoglobin minimal 12.5 g/dL',
                'Hemoglobin.max'       =>  'Nilai hemoglobin maksimal 17.0 g/dL',


                'Pressure_Sistole.required'  =>  'Mohon field tekanan sistole diisi ',
                'Pressure_Sistole.integer'   =>  'Field tekanan sistole hanya menerima inputan angka bulat ',
                'Pressure_Sistole.min'       =>  'Nilai tekanan sistole minimal 100 mmHg',
                'Pressure_Sistole.max'       =>  'Nilai tekanan sistole maksimal 170 mmHg',

                'Pressure_Diastole.required'  =>  'Mohon field tekanan diastole diisi ',
                'Pressure_Diastole.integer'   =>  'Field tekanan diastole hanya menerima inputan angka bulat ',
                'Pressure_Diastole.min'       =>  'Nilai tekanan diastole minimal 70 mmHg',
                'Pressure_Diastole.max'       =>  'Nilai tekanan diastole maksimal 100 mmHg'
            ])->validate();

            $Data_Name_Month = $this->getMonthNameTransaction($request->ChartFromData, $request->ChartToData);
            $Data_Transaction_Each_Month = $this->getDataLineChartDashboard($request->ChartFromData, $request->ChartToData);
            session()->flashInput($request->input());
            return view('index', compact('latest_inbox', 'latest_notification', 'datasets_today_blood', 
                                                        'Data_Name_Month', 'Data_Transaction_Each_Month'));
        }
        else{
            $Data_Name_Month = $this->getMonthNameTransaction($request->ChartFromData, $request->ChartToData);
            $Data_Transaction_Each_Month = $this->getDataLineChartDashboard($request->ChartFromData, $request->ChartToData);
            Session()->flashInput($request->input());
            return view('index', compact('latest_inbox', 'latest_notification', 
                                                        'datasets_today_blood', 'Data_Name_Month', 'Data_Transaction_Each_Month'));
        }
    }

    public function CekHistoryDonor(){
        $history_transaction_donor = TransactionDonor::all()
                                        ->where('User_Pendonor_id', '=', Auth()->user()->id);
        $latest_inbox = $this->GetLatestInbox();
        $latest_notification = $this->GetLatestNotification();
        return view('HomeDashboard.HistoryBlood', compact('history_transaction_donor', 'latest_inbox', 'latest_notification'));
    }

    public function CekTransactionHistory(TransactionDonor $TransactionDonor){
        $Transactions = TransactionDonor::where('User_Pendonor_id', '=', Auth()->User()->id)
        ->where('Code_Transaction', '=', $TransactionDonor->Code_Transaction)->first();
        $date_today = Carbon::now('Asia/Makassar')->toDateString();
        $latest_inbox = $this->GetLatestInbox();
        $latest_notification = $this->GetLatestNotification();
        return view('HomeDashboard.DetailHistoryBlood', compact('Transactions', 'date_today', 'latest_inbox', 'latest_notification'));
    }

    public function Printout_Transaction(TransactionDonor $TransactionDonor){
        $data = $TransactionDonor::with('User_Connection.Rhesus_Connection')
                    ->where('User_Pendonor_id', '=', Auth::user()->id)
                    ->where('Code_Transaction', '=', $TransactionDonor->Code_Transaction)
                    ->firstorFail();
        return view('HomeDashboard.PrintDetail', compact('data'));
    }

    public function RedirectSettingsAccount(){
        $latest_inbox = $this->GetLatestInbox();
        $latest_notification = $this->GetLatestNotification();
        $data_user = User::with('Rhesus_Connection', 'Transaction_Connect')
                            ->where('NIK', '=', Auth::user()->NIK)
                            ->firstOrFail();
        return view('HomeDashboard.SettingAccount', compact('data_user', 'latest_inbox', 'latest_notification'));
    }

    public function ChangePasswordAccount($OldPassword, $Password_New, $Confirm_Password_New){
        return $OldPassword;
    }

    public function UpdateSettingsAccount(AccountSettingValidation $request){
        $data_has_been_validated = $request->validated();
        $data_has_been_validated['update_at'] = Carbon::now('Asia/Makassar');

        if($request->hasFile('profile_picture')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $date = Carbon::now('Asia/Makassar')->format('dmYHi');
            $HashNameImage = $request->file('profile_picture')->hashName();
            $ImageName = $date."-".$HashNameImage;
            $path_name = $request->file('profile_picture')->storeAs('image-profiles', $ImageName);
            $data_has_been_validated['profile_picture'] = $path_name;
        }

        $account_user = User::findOrFail(Auth::user()->id);
        $account_user->update($data_has_been_validated);

        return redirect()->back()->with('Status_Success', 'Data akun anda berhasil diperbaharui !');
    }

   
}
