<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RhesusCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
    ];


    public function User_Connection(){
        return $this->hasMany(User::class, 'Rhesus_id', 'id');
    }

    public function Training_Connection(){
        return $this->hasMany(DataTraining::class, 'Rhesus_id', 'id');
    }
    
    public function Testing_Connection(){
        return $this->hasMany(DataTesting::class, 'Rhesus_id', 'id');
    }
}
