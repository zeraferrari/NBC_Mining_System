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

    public function CountingRhesus_Data($RhesusCategory){
        return User::with('Rhesus_Connection')->get()
        ->where('Rhesus_Connection.Name', '=', $RhesusCategory)->count();
    }

    public function CountBloodTransaction($TypeRhesus){
        return TransactionDonor::with('User_Connection.Rhesus_Connection')->get()
                                ->where('Status_Donor', '=', 'Berhasil Mendonor')
                                ->where('User_Connection.Rhesus_Connection.Name', '=', $TypeRhesus)
                                ->count();
    }

    public function getNameMonth(){
        $MonthNumber = TransactionDonor::with('User_Connection.Rhesus_Connection')->pluck('created_at');
        
        $temp_Month = [];
 
        foreach ($MonthNumber as $key => $value) {
            $temp_Month[] = date('F-Y', strtotime($value));
         }
 
         $MonthName = array_values(array_unique($temp_Month));
         return $MonthName;
    }

    function getStructLineChartJSON(){
        $Transaction_Each_Month = TransactionDonor::with('User_Connection.Rhesus_Connection')->get()
        ->where('Status_Donor', '=', 'Berhasil Mendonor')
        ->groupBy(function($val){
            return Carbon::parse($val->created_at)->format('F-Y');
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

        // dd($datasets);

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

    public function index(){
        $title = $this->title;
        $total_users = User::CountingUsers();
        $already_donated_users = User::AlreadyDonated();
        $havent_donated_users = User::HaventDonated();
        $Rhesus_A_Plus = $this->CountingRhesus_Data('A+');
        $Rhesus_B_Plus = $this->CountingRhesus_Data('B+');
        $Rhesus_O_Plus = $this->CountingRhesus_Data('O+');
        $Rhesus_AB_Plus = $this->CountingRhesus_Data('AB+');
        $Rhesus_A_Negative = $this->CountingRhesus_Data('A-');
        $Rhesus_B_Negative = $this->CountingRhesus_Data('B-');
        $Rhesus_O_Negative = $this->CountingRhesus_Data('O-');
        $Rhesus_AB_Negative = $this->CountingRhesus_Data('AB-');
        $Count_Data_Each_Rhesus = RhesusCategory::with('User_Connection')->withCount('User_Connection as Jumlah_User')->pluck('Jumlah_User')->toArray(); 
        $Name_Rhesus = RhesusCategory::with('Rhesus_Connection')->pluck('Name')->toArray();
        $Total_Transaction = TransactionDonor::CountTransaction();
        $Transaction_Success = TransactionDonor::CountTransactionSuccess();
        $Transaction_Fails = TransactionDonor::CountTransactionFails();
        $TB_Count_A_Plus = $this->CountBloodTransaction('A+');
        $TB_Count_B_Plus = $this->CountBloodTransaction('B+');
        $TB_Count_O_Plus = $this->CountBloodTransaction('O+');
        $TB_Count_AB_Plus = $this->CountBloodTransaction('AB+');
        $TB_Count_A_Negative = $this->CountBloodTransaction('A-');
        $TB_Count_B_Negative = $this->CountBloodTransaction('B-');
        $TB_Count_O_Negative = $this->CountBloodTransaction('O-');
        $TB_Count_AB_Negative = $this->CountBloodTransaction('AB-');
        // $Result = RhesusCategory::withCount(['User_Connection as Total_Kantong_Darah' => function($query){
        //     $query->join('transaction_donors', 'transaction_donors.User_Pendonor_id', '=', 'users.id')
        //             ->where('transaction_donors.Status_Donor', '=', 'Berhasil Mendonor')
        //             ->where('transaction_donors.created_at', '>=', '2022-03-15 00:00:00')
        //             ->where('transaction_donors.created_at', '<=', '2022-04-09 23:59:59');
        // }])->with(['User_Connection.Transaction_Connect' => function($query){
        //             $query->where('transaction_donors.created_at', '>=', '2022-03-15 00:00:00')
        //             ->where('transaction_donors.created_at', '<=', '2022-04-09 23:59:59')
        //             ->where('transaction_donors.Status_Donor', '=', 'Berhasil Mendonor');
        // }])->get();
        $Month_Name = $this->getNameMonth();
        $Json_Line_Chart = $this->getStructLineChartJSON();
        return view('Manajement.Dashboard.index', compact('title',
                                                                        'total_users',
                                                                        'already_donated_users',
                                                                        'havent_donated_users',
                                                                        'Rhesus_A_Plus', 'Rhesus_B_Plus', 'Rhesus_O_Plus', 'Rhesus_AB_Plus',
                                                                        'Rhesus_A_Negative', 'Rhesus_B_Negative', 'Rhesus_O_Negative', 'Rhesus_AB_Negative',
                                                                        'Count_Data_Each_Rhesus',
                                                                        'Name_Rhesus',
                                                                        'Total_Transaction',
                                                                        'Transaction_Success',
                                                                        'Transaction_Fails',
                                                                        'TB_Count_A_Plus', 'TB_Count_B_Plus', 'TB_Count_O_Plus', 'TB_Count_AB_Plus',
                                                                        'TB_Count_A_Negative', 'TB_Count_B_Negative', 'TB_Count_O_Negative', 'TB_Count_AB_Negative',
                                                                        'Month_Name', 'Json_Line_Chart'
                                                                    ));
    }

    

    public function test(Request $request){
        $Transaction_Each_Month = TransactionDonor::with('User_Connection.Rhesus_Connection')->get()
        ->where('created_at', '>=', $request->ChartFromData.' 00:00:00')
        ->where('created_at', '<=', $request->ChartToData.' 23:59:59')
        ->groupBy(function($val){
            return Carbon::parse($val->created_at)->format('F-Y');
        });

        dd($Transaction_Each_Month);
        

        $Data_Rhesus = RhesusCategory::all();
        
        $datasets = [];
        foreach($Data_Rhesus as $Each_Rhesus){
            array_push($datasets, (object) [
                'label'  => $Each_Rhesus->Name,
                'data'  => [],
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
                    }
                }
            }
        }
    $structer_transaction_json = json_encode($datasets);
    } 
}
