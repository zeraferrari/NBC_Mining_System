<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Models\TransactionDonor;
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
    public function index()
    {
        if(Auth::guest()){
            return view('index');
        }elseif(Auth::user()->hasRole(['Petugas Medis', 'Pendonor'])){
            return view('index');
        }elseif(Auth::user()->hasRole(['Administrator'])){
            return redirect()->route('Manajement.Dashboard.index');    
        }
    }

    public function CekHistoryDonor(){
        $history_transaction_donor = TransactionDonor::all()
                                        ->where('User_Pendonor_id', '=', Auth()->user()->id);
        return view('HomeDashboard.HistoryBlood', compact('history_transaction_donor'));
    }

    public function CekTransactionHistory(TransactionDonor $TransactionDonor){
        $Transactions = TransactionDonor::all()
        ->where('User_Pendonor_id', '=', Auth()->User()->id)
        ->where('Code_Transaction', '=', $TransactionDonor->Code_Transaction);
        
    }
}
