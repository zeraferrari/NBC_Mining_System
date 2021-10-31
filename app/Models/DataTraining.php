<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTraining extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'Gender',
        'Hemoglobin',
        'Pressure_sistole',
        'Pressure_diastole',
        'Weight',
        'Status',
        'Age',
        'Rhesus_id',
    ];

    public function Rhesus_Connection(){
        return $this->belongsTo(RhesusCategory::class, 'Rhesus_id', 'id');
    }
}
