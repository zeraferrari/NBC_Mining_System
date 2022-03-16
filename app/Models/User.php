<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PDO;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'NIK',
        'Gender',
        'phone_number',
        'alamat',
        'profile_picture',
        'Status_Donor',
        'Rhesus_id',
        'create_at',
        'update_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function Rhesus_Connection(){
        return $this->belongsTo(RhesusCategory::class, 'Rhesus_id','id');
    }

    public function Transaction_Connect(){
        return $this->hasMany(TransactionDonor::class, 'User_Pendonor_id', 'id');
    }

    public function Petugas_Transaction_Connect(){
        return $this->hasMany(TransactionDonor::class, 'User_PM_id', 'id');
    }

    public function scopeCountingUsers($query){
        return $query->count();
    }

    public function scopeAlreadyDonated($query){
        return $query->where('Status_Donor', 'Sudah Mendonor')->count();
    }

    public function scopeHaventDonated($query){
        return $query->where('Status_Donor', 'Belum Mendonor')->count();
    }
}
