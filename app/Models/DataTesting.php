<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTesting extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'Gender',
        'Hemoglobin',
        'Pressure_Sistole',
        'Pressure_diastole',
        'Weight',
        'Age',
        'Status',
        'Result_Classification',
        'Rhesus_id',
    ];

    public function Rhesus_Connection(){
        return $this->belongsTo(RhesusCategory::class, 'Rhesus_id', 'id');
    }
}
