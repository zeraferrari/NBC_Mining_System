<?php

namespace App\Http\Controllers;

use App\Models\RhesusCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Dashboard extends Controller
{
    protected $title = 'Manajement Main Dashboard';

    public function CountingRhesus_Data($RhesusCategory){
        return User::with('Rhesus_Connection')->get()->where('Rhesus_Connection.Name', '=', $RhesusCategory)->count();
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
        return view('Manajement.Dashboard.index', compact('title',
                                                                        'total_users',
                                                                        'already_donated_users',
                                                                        'havent_donated_users',
                                                                        'Rhesus_A_Plus',
                                                                        'Rhesus_B_Plus',
                                                                        'Rhesus_O_Plus',
                                                                        'Rhesus_AB_Plus',
                                                                        'Rhesus_A_Negative',
                                                                        'Rhesus_B_Negative',
                                                                        'Rhesus_O_Negative',
                                                                        'Rhesus_AB_Negative',
                                                                        'Count_Data_Each_Rhesus',
                                                                        'Name_Rhesus',
                                                                    
                                                                    ));
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
