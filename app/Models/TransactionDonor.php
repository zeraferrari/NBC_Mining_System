<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class TransactionDonor extends Model
{
    use HasFactory;

    protected $fillable = [
        'Code_Transaction',
        'Age',
        'Weight',
        'Hemoglobin',
        'Pressure_sistole',
        'Pressure_diastole',
        'Waktu_Donor',
        'Kembali_Donor',
        'Status_Transaction',
        'User_Pendonor_id',
        'User_PM_id'
    ];

    public function User_Connection(){
        return $this->belongsTo(User::class, 'User_Pendonor_id','id');
    }
}
