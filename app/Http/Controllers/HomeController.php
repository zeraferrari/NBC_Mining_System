<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Models\RhesusCategory;
use App\Models\TransactionDonor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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

    public function index()
    {
        $latest_inbox = $this->GetLatestInbox();
        $latest_notification = $this->GetLatestNotification();
        $datasets_today_blood = $this->Statistic_Blood();

        return view('index', compact('latest_inbox', 'latest_notification', 'datasets_today_blood'));
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

}
