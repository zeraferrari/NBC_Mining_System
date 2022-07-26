<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

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
            $latest_inbox = TransactionDonor::latest()->take(5)->get();
            return $latest_inbox;
        }else{
            $latest_inbox = TransactionDonor::where('User_Pendonor_id', '=', Auth()->User()->id)
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
            $latest_notification = TransactionDonor::where('User_Pendonor_id', '=', Auth::User()->id)
            ->latest()->take(5)->get();
            return $latest_notification;
        }elseif(Auth::User()->roles[0]->name === 'Petugas Medis'){
            $latest_notification = TransactionDonor::where('User_PM_id', '=', Auth::User()->id)
            ->latest()->take(5)->get();
            return $latest_notification;
        }elseif(Auth::User()->roles[0]->name === 'Administrator'){
            $latest_notification = TransactionDonor::whereNotIn('Status_Donor', ['Medical Check'])
            ->latest()->take(5)->get();
            return $latest_notification;
        }
    }

    public function index()
    {
        $latest_inbox = $this->GetLatestInbox();
        $latest_notification = $this->GetLatestNotification();
        return view('index', compact('latest_inbox', 'latest_notification'));
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

}
