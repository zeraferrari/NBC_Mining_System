<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Models\RhesusCategory;
use App\Models\TransactionDonor;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
                        if($each_transaction_month->User_Connection->Rhesus_id === $data_rhesus[$key]->id){
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
        }else{
            $Data_Name_Month = $this->getMonthNameTransaction($request->ChartFromData, $request->ChartToData);
            $Data_Transaction_Each_Month = $this->getDataLineChartDashboard($request->ChartFromData, $request->ChartToData);
            return view('index', compact('latest_inbox', 'latest_notification', 'datasets_today_blood', 
                                                        'Data_Name_Month', 'Data_Transaction_Each_Month'));
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

}
