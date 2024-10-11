<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectricityMeter extends Model
{
    protected $table = 'electricitymeters';
    protected $fillable = [
        'idhouse',
        'nis',
        'measurement',
        'date'
    ];
}
