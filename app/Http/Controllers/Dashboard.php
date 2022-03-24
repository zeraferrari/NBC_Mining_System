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
        $Result = RhesusCategory::withCount(['User_Connection as Total_Kantong_Darah' => function($query){
            $query->join('transaction_donors', 'transaction_donors.User_Pendonor_id', '=', 'users.id')
                    ->where('transaction_donors.Status_Donor', '=', 'Berhasil Mendonor')
                    ->where('transaction_donors.created_at', '>=', '2022-03-15 00:00:00')
                    ->where('transaction_donors.created_at', '<=', '2022-04-09 23:59:59');
        }])->with(['User_Connection.Transaction_Connect' => function($query){
                    $query->where('transaction_donors.created_at', '>=', '2022-03-15 00:00:00')
                    ->where('transaction_donors.created_at', '<=', '2022-04-09 23:59:59')
                    ->where('transaction_donors.Status_Donor', '=', 'Berhasil Mendonor');
        }])->get();
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
                                                                        'Result'
                                                                    ));
    }

    public function test(Request $request){
        $test = TransactionDonor::all();
        
        $t = $test[0]->created_at->format('F');

        
       
        // $test = DB::table('transaction_donors')
        // ->join('users','User_Pendonor_id', '=', 'users.id')
        // ->rightJoin('rhesus_categories', function($join){
        //     $join->on('users.Rhesus_id', '=', 'rhesus_categories.id')
        //     ->where('transaction_donors.Status_Donor', '=', 'Berhasil Mendonor');
        // })
        // ->select('rhesus_categories.Name', DB::raw('Count(transaction_donors.id), MONTHNAME(transaction_donors.created_at)'))
        // ->groupByRaw('MONTHNAME(transaction_donors.created_at), rhesus_categories.Name')
        // ->orderBy('rhesus_categories.id', 'asc')
        // ->get();
    }
    
    // public function test(Request $request){    
    //     $FromDate = $request->FromDate;
    //     $ToDate = $request->ToDate;
    //     $result = RhesusCategory::with('User_Connection')
    //                              ->withCount(['User_Connection' => function($query)use($FromDate, $ToDate){
    //                                                 $query->where('users.create_at', '>=', $FromDate)
    //                                                 ->where('users.create_at', '<=', $ToDate);
    //                             }])->get();
    //     return redirect()->route('Manajement.Dashboard.index', compact('result'));
    // }   
}
