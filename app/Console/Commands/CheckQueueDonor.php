<?php

namespace App\Console\Commands;

use App\Models\TransactionDonor;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class CheckQueueDonor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckQueueDonor:EveryFifteenMinute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perintah untuk mengecek antrian donor darah setiap 15 menit';

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
        $Time_Now = Carbon::now()->timezone('Asia/Makassar');
        $data = TransactionDonor::with('User_Connection.Rhesus_Connection')
                ->where('Status_Donor', '=', 'Medical Check')
                ->get();
        foreach ($data as $key => $value) {
            $FifteenMinuteLater = Carbon::parse($data[$key]->created_at)->addMinutes('15');
            if($Time_Now > $FifteenMinuteLater){
                $data[$key]->delete();
            }
        }
        Log::info('Schedule Queue Transaction Successfully Running !');
    }
}
