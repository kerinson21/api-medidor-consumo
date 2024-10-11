<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = 'devices';
    protected $fillable = [
        'code',
        'name',
        'description'
    ];

    public function readings(){
        return $this->hasMany('App\Models\Reading');
    }
    public function assigneds(){
        return $this->hasMany('App\Models\Assigned');
    }
}
