<?php

namespace App\Console\Commands;

use App\Models\TransactionDonor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckStatusDonorUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckStatusDonorUsers:Daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check status donor setiap hari untuk setiap user yang teregister';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::with('Rhesus_Connection','transaction_connect')
                    ->whereHas('Transaction_Connect', function($query){
                        $query->whereIn('Status_Donor', ['Berhasil Mendonor', 'Gagal Donor']);
                    })->get();
        $now = Carbon::now()->isoFormat('YYYY-MM-DD');
        foreach ($users as $key => $value) {
            $transaksi = TransactionDonor::with('User_Connection.Rhesus_Connection')
                    ->whereIn('Status_Donor', ['Berhasil Mendonor', 'Gagal Donor'])
                    ->where('User_Pendonor_id', '=', $users[$key]->id)
                    ->latest()
                    ->first();
            if($transaksi->Kembali_Donor === $now){
                $users[$key]->update([
                    'Status_Donor'  =>  'Belum Mendonor'
                ]);
            }
        }
        Log::info('Schedule Status Donor Check Successfully Running !');
    }
}
