<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


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
        'Status_Donor',
        'User_Pendonor_id',
        'User_PM_id'
    ];

    public function User_Connection(){
        return $this->belongsTo(User::class, 'User_Pendonor_id','id');
    }

    public function Petugas_Connection(){
        return $this->belongsTo(User::class, 'User_PM_id', 'id');
    }

    public function scopeCountTransaction($query){
        return $query->whereIn('Status_Donor', ['Berhasil Mendonor', 'Gagal Donor'])->count();
    }

    public function scopeCountTransactionSuccess($query){
        return $query->where('Status_Donor', 'Berhasil Mendonor')->count();
    }

    public function scopeCountTransactionFails($query){
        return $query->where('Status_Donor', 'Gagal Donor')->count();
    }
}
