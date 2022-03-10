<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        $kadal = 70;
        $kadal = json_encode($kadal);
        
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
                                                                        'kadal',
                                                                    ));
    }
    
    public function test(Request $request){
        dd($request->all());
    }
}
