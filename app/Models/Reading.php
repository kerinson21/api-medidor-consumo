<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    protected $table = 'readings';
    protected $fillable = [
        'iddevice',
        'consumption',
        'date_hour'
    ];
    public $timestamps = false;
    public function devices(){
        return $this->belongsTo('App\Models\Device');
    }

}
