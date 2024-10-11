<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assigned extends Model
{
    protected $table = 'assigneds';
    protected $fillable = [
        'iduser',
        'iddevice',
    ];
    public $timestamps = false;
    public function devices(){
        return $this->belongsTo('App\Models\Device');
    }
    public function users(){
        return $this->belongsTo('App\Models\User');
    }
}
