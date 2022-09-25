<?php

namespace App\Http\Controllers;

use App\Models\RhesusCategory;
use App\Models\TransactionDonor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class Dashboard extends Controller
{
    protected $title = 'Manajement Main Dashboard';

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function CountingAllUser(){
        $data = User::count();
        return $data;
    }

    public function CountUser_AlreadyDonated(){
        $data = User::where('Status_Donor', '=', 'Sudah Mendonor')->get()->count();
        return $data;
    }

    public function CountUser_HaventDonated(){
        $data = User::where('Status_Donor', '=', 'Belum Mendonor')->get()->count();
        return $data;
    }

    public function GetEachRhesus_UserRegisterd(){
        $TotalEachRhesus = RhesusCategory::with('User_Connection')
        ->withCount('User_Connection as Total_EachRhesus')
        ->get();

        return $TotalEachRhesus;
    }

    public function GetCountRhesus_BloodTransaction(){
        $CountBlood_Transaction = RhesusCategory::with('User_Connection.Transaction_Connect')
        ->withCount(['User_Connection as Total_CountRhesus_Transaction' => function($query){
            $query->join('transaction_donors', 'User_Pendonor_id', '=', 'users.id')
            ->where('transaction_donors.Status_Donor', '=', 'Berhasil Mendonor');
        }])
        ->get();

        return $CountBlood_Transaction;
    }

    public function GetCount_AllTransaction(){
        $data = TransactionDonor::whereIn('Status_Donor', ['Berhasil Mendonor', 'Gagal Donor'])->count();
        return $data;
    }

    public function GetCount_SuccessTransaction(){
        $data = TransactionDonor::where('Status_Donor', '=', 'Berhasil Mendonor')->count();
        return $data;
    }

    public function GetCount_FailedTransaction(){
        $data = TransactionDonor::where('Status_Donor', '=', 'Gagal Donor')->count();
        return $data;
    }

    public function DataEachRhesus_UserByDate($FromDate, $ToDate){
        $TotalUser_Each_Rhesus = RhesusCategory::with('User_Connection')
        ->withCount(['User_Connection as Total_EachRhesus' => function($callbacks)use($FromDate, $ToDate){
            $callbacks->where('users.created_at', '>=', $FromDate.' 00:00:00')
                     ->where('users.created_at', '<=', $ToDate.' 23:59:59');
        }])
        ->get();
        return $TotalUser_Each_Rhesus;
    }

    public function CountingDataUser_ByDate($FromDate, $ToDate){
        $data = User::where('created_at', '>=', $FromDate.' 00:00:00')
        ->where('created_at', '<=', $ToDate.' 23:59:59')
        ->count();
        return $data;
    }

    public function CountDataUser_AlreadyDonated_ByDate($FromDate, $ToDate){
        $data = User::where('Status_Donor', '=', 'Sudah Mendonor')
        ->where('created_at', '>=', $FromDate.' 00:00:00')
        ->where('created_at', '<=', $ToDate.' 23:59:59')
        ->count();
        return $data;
    }

    public function CountDataUser_HaventDonated_ByDate($FromDate, $ToDate){
        $data = User::where('Status_Donor', '=', 'Belum Mendonor')
        ->where('created_at', '>=', $FromDate.' 00:00:00')
        ->where('created_at', '<=', $ToDate.' 23:59:59')
        ->count();
        return $data;
    }

    public function GetCount_AllTransaction_ByDate($FromDate, $ToDate){
        $data = TransactionDonor::whereIn('Status_Donor', ['Berhasil Mendonor', 'Gagal Donor'])
        ->where('created_at', '>=', $FromDate.' 00:00:00')
        ->where('created_at', '<=', $ToDate.' 23:59:59')
        ->count();
        return $data;
    }

    public function GetCount_SuccessTransaction_ByDate($FromDate, $ToDate){
        $data = TransactionDonor::where('Status_Donor', '=', 'Berhasil Mendonor')
        ->where('created_at', '>=', $FromDate.' 00:00:00')
        ->where('created_at', '<=', $ToDate.' 23:59:59')
        ->count();
        return $data;
    }

    public function GetCount_FailedTransaction_ByDate($FromDate, $ToDate){
        $data = TransactionDonor::where('Status_Donor', '=', 'Gagal Donor')
        ->where('created_at', '>=', $FromDate.' 00:00:00')
        ->where('created_at', '<=', $ToDate.' 23:59:59')
        ->count();
        return $data;
    }

    public function GetCountRhesus_BloodTransaction_ByDate($FromDate, $ToDate){
        $CountBlood_Transaction = RhesusCategory::with('User_Connection.Transaction_Connect')
        ->withCount(['User_Connection as Total_CountRhesus_Transaction' => function($query)use($FromDate, $ToDate){
            $query->join('transaction_donors', 'User_Pendonor_id', '=', 'users.id')
            ->where('transaction_donors.Status_Donor', '=', 'Berhasil Mendonor')
            ->where('transaction_donors.created_at', '>=', $FromDate.' 00:00:00')
            ->where('transaction_donors.created_at', '<=', $ToDate.' 23:59:59');
        }])
        ->get();

        return $CountBlood_Transaction;
    }

    public function getNameMonth($FromDate, $ToDate){

        if(isset($FromDate) AND isset($ToDate)){
            $MonthNumber = TransactionDonor::with('User_Connection.Rhesus_Connection')
            ->where('created_at', '>=', $FromDate.' 00:00:00')
            ->where('created_at', '<=', $ToDate.' 23:59:59')
            ->pluck('created_at')
            ->sortBy('created_at')->toArray();
        
            $Month_Time = array_map(function($value){
                return strtotime($value);
            }, $MonthNumber);
            
            sort($Month_Time);

            $Month_Name = array_map(function($value){
                return \Carbon\Carbon::parse($value)->isoFormat('MMMM-YYYY');
            }, $Month_Time);

            $Month_Name = array_values(array_unique($Month_Name));

            return $Month_Name;
        }else{
            $now = Carbon::now()->format('Y');
            $MonthNumber = TransactionDonor::with('User_Connection.Rhesus_Connection')
            ->where('created_at', 'like', '%'.$now.'%')
            ->pluck('created_at')
            ->sortBy('created_at')->toArray();
            
            $Month_Time = array_map(function($value){
                return strtotime($value);
            }, $MonthNumber);
            
            sort($Month_Time);

            $Month_Name = array_map(function($value){
                return \Carbon\Carbon::parse($value)->isoFormat('MMMM-YYYY');
            }, $Month_Time);

            $Month_Name = array_values(array_unique($Month_Name));

            return $Month_Name;
        }

    }


    function getStructLineChartJSON($FromDate, $ToDate){
        
        if(isset($FromDate) AND isset($ToDate)){
            $Transaction_Each_Month = TransactionDonor::with('User_Connection.Rhesus_Connection')->get()
            ->where('Status_Donor', '=', 'Berhasil Mendonor')
            ->where('created_at', '>=', $FromDate.' 00:00:00')
            ->where('created_at', '<=', $ToDate.' 23:59:59')
            ->sortBy('created_at')
            ->groupBy(function($val){
                // return Carbon::parse($val->created_at)->format('F-Y');
                return Carbon::parse($val->created_at)->isoFormat('MMMM-YYYY');
            });
            $Data_Rhesus = RhesusCategory::all();
            
            $datasets = [];
            foreach($Data_Rhesus as $index => $value){
                array_push($datasets, (object) [
                    'label'  => $Data_Rhesus[$index]->Name,
                    'data'  => [],
                    'BorderColor' => '',
                    'BackgroundColor' => '',
                ]);
            }

            foreach($Transaction_Each_Month as $Each_Month_Transaction){
                foreach($Data_Rhesus as $Each_Data_Rhesus){
                    $count_data_each_rhesus = 0;
                    foreach($Each_Month_Transaction as $Each_Transaction){
                        if($Each_Transaction->User_Connection->Rhesus_Connection->id === $Each_Data_Rhesus->id){
                            $count_data_each_rhesus++;
                        }
                    }

                    foreach ($Data_Rhesus as $key => $value) {
                        if($Each_Data_Rhesus->Name == $datasets[$key]->label){
                            $datasets[$key]->data[] = $count_data_each_rhesus;
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
            }
            $structer_transaction_json = json_encode($datasets);
            return $structer_transaction_json;  
        }else{
            $now = Carbon::now()->format('Y');
            $Transaction_Each_Month = TransactionDonor::with('User_Connection.Rhesus_Connection')
            ->where('Status_Donor', '=', 'Berhasil Mendonor')
            ->where('created_at', 'like', '%'.$now.'%')->get()
            ->sortBy('created_at')
            ->groupBy(function($val){
                // return Carbon::parse($val->created_at)->format('F-Y');
                return Carbon::parse($val->created_at)->isoFormat('MMMM-YYYY');
            });

            $Data_Rhesus = RhesusCategory::all();
            
            $datasets = [];
            foreach($Data_Rhesus as $index => $value){
                array_push($datasets, (object) [
                    'label'  => $Data_Rhesus[$index]->Name,
                    'data'  => [],
                    'BorderColor' => '',
                    'BackgroundColor' => '',
                ]);
            }

            foreach($Transaction_Each_Month as $Each_Month_Transaction){
                foreach($Data_Rhesus as $Each_Data_Rhesus){
                    $count_data_each_rhesus = 0;
                    foreach($Each_Month_Transaction as $Each_Transaction){
                        if($Each_Transaction->User_Connection->Rhesus_Connection->id === $Each_Data_Rhesus->id){
                            $count_data_each_rhesus++;
                        }
                    }

                    foreach ($Data_Rhesus as $key => $value) {
                        if($Each_Data_Rhesus->Name == $datasets[$key]->label){
                            $datasets[$key]->data[] = $count_data_each_rhesus;
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
            }
            $structer_transaction_json = json_encode($datasets);
            return $structer_transaction_json;   
        }
    }

    public function index(Request $request){
        if($request->has('ChartFromData_Rhesus') AND $request->has('ChartToData_Rhesus')){
            $Navigator = new HomeController();
            $latest_inbox = $Navigator->GetLatestInbox();
            $latest_notification = $Navigator->GetLatestNotification();
            $title = $this->title;
            $total_users = $this->CountingDataUser_ByDate($request->ChartFromData_Rhesus, $request->ChartToData_Rhesus);
            $already_donated_users = $this->CountDataUser_AlreadyDonated_ByDate($request->ChartFromData_Rhesus, $request->ChartToData_Rhesus);
            $havent_donated_users = $this->CountDataUser_HaventDonated_ByDate($request->ChartFromData_Rhesus, $request->ChartToData_Rhesus);
            $Value_EachRhesus = $this->DataEachRhesus_UserByDate($request->ChartFromData_Rhesus, $request->ChartToData_Rhesus);
            $Count_RhesusBloodTransaction = $this->GetCountRhesus_BloodTransaction();
            $Total_Transaction = $this->GetCount_AllTransaction();
            $Transaction_Success = $this->GetCount_SuccessTransaction();
            $Transaction_Fails = $this->GetCount_FailedTransaction();
            $Count_Data_Each_Rhesus = $Value_EachRhesus->pluck('Total_EachRhesus')->toArray();
            $Name_Rhesus = RhesusCategory::with('Rhesus_Connection')->pluck('Name')->toArray();
            $Month_Name = $this->getNameMonth($request->ChartFromDataTransaction, $request->ChartToDataTransaction);
            $Json_Line_Chart = $this->getStructLineChartJSON($request->ChartFromDataTransaction, $request->ChartToDataTransaction);
            session()->flashInput($request->input());
            return view('Manajement.Dashboard.index', compact('title',
                                                                            'latest_inbox', 'latest_notification',
                                                                            'total_users',
                                                                            'already_donated_users',
                                                                            'havent_donated_users',
                                                                            'Value_EachRhesus', 'Count_RhesusBloodTransaction',
                                                                            'Count_Data_Each_Rhesus',
                                                                            'Name_Rhesus',
                                                                            'Total_Transaction',
                                                                            'Transaction_Success',
                                                                            'Transaction_Fails',
                                                                            'Month_Name', 'Json_Line_Chart',
                                                                        ));
        }elseif($request->has('ChartFromDataTransaction') AND $request->has('ChartToDataTransaction')){
            $Navigator = new HomeController();
            $latest_inbox = $Navigator->GetLatestInbox();
            $latest_notification = $Navigator->GetLatestNotification();
            $title = $this->title;
            $total_users = $this->CountingAllUser();
            $already_donated_users = $this->CountUser_AlreadyDonated();
            $havent_donated_users = $this->CountUser_HaventDonated();
            $Value_EachRhesus = $this->GetEachRhesus_UserRegisterd();
            $Count_RhesusBloodTransaction = $this->GetCountRhesus_BloodTransaction_ByDate($request->ChartFromDataTransaction, $request->ChartToDataTransaction);
            $Total_Transaction = $this->GetCount_AllTransaction_ByDate($request->ChartFromDataTransaction, $request->ChartToDataTransaction);
            $Transaction_Success = $this->GetCount_SuccessTransaction_ByDate($request->ChartFromDataTransaction, $request->ChartToDataTransaction);
            $Transaction_Fails = $this->GetCount_FailedTransaction_ByDate($request->ChartFromDataTransaction, $request->ChartToDataTransaction);
            $Count_Data_Each_Rhesus = $Value_EachRhesus->pluck('Total_EachRhesus')->toArray();
            $Name_Rhesus = RhesusCategory::with('Rhesus_Connection')->pluck('Name')->toArray();
            $Month_Name = $this->getNameMonth($request->ChartFromDataTransaction, $request->ChartToDataTransaction);
            $Json_Line_Chart = $this->getStructLineChartJSON($request->ChartFromDataTransaction, $request->ChartToDataTransaction);
            session()->flashInput($request->input());
            return view('Manajement.Dashboard.index', compact('title',
                                                                            'latest_inbox', 'latest_notification',
                                                                            'total_users',
                                                                            'already_donated_users',
                                                                            'havent_donated_users',
                                                                            'Value_EachRhesus', 'Count_RhesusBloodTransaction',
                                                                            'Count_Data_Each_Rhesus',
                                                                            'Name_Rhesus',
                                                                            'Total_Transaction',
                                                                            'Transaction_Success',
                                                                            'Transaction_Fails',
                                                                            'Month_Name', 'Json_Line_Chart',
                                                                        ));
        }else{
            $Navigator = new HomeController();
            $latest_inbox = $Navigator->GetLatestInbox();
            $latest_notification = $Navigator->GetLatestNotification();
            $title = $this->title;
            $total_users = $this->CountingAllUser();
            $already_donated_users = $this->CountUser_AlreadyDonated();
            $havent_donated_users = $this->CountUser_HaventDonated();
            $Value_EachRhesus = $this->GetEachRhesus_UserRegisterd();
            $Count_RhesusBloodTransaction = $this->GetCountRhesus_BloodTransaction();
            $Total_Transaction = $this->GetCount_AllTransaction();
            $Transaction_Success = $this->GetCount_SuccessTransaction();
            $Transaction_Fails = $this->GetCount_FailedTransaction();
            $Count_Data_Each_Rhesus = $Value_EachRhesus->pluck('Total_EachRhesus')->toArray();
            $Name_Rhesus = RhesusCategory::with('Rhesus_Connection')->pluck('Name')->toArray();
            $Month_Name = $this->getNameMonth($request->ChartFromDataTransaction, $request->ChartToDataTransaction);
            $Json_Line_Chart = $this->getStructLineChartJSON($request->ChartFromDataTransaction, $request->ChartToDataTransaction);
            return view('Manajement.Dashboard.index', compact('title',
                                                                            'latest_inbox', 'latest_notification',
                                                                            'total_users',
                                                                            'already_donated_users',
                                                                            'havent_donated_users',
                                                                            'Value_EachRhesus', 'Count_RhesusBloodTransaction',
                                                                            'Count_Data_Each_Rhesus',
                                                                            'Name_Rhesus',
                                                                            'Total_Transaction',
                                                                            'Transaction_Success',
                                                                            'Transaction_Fails',
                                                                            'Month_Name', 'Json_Line_Chart',
                                                                        ));
        }
    }
}
