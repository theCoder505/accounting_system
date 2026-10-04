<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    use HasFactory;
    public function division(){
        return $this->belongsTo('App\Models\Division', 'division_id');
    }

    public function zila(){
        return $this->belongsTo('App\Models\Zila', 'zila_id');
    }


}
