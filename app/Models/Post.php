<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public function author(){
        return $this->belongsTo('App\Models\Admin', 'author_id');
    }

    public function division(){
        return $this->belongsTo('App\Models\Division', 'division_id');
    }

    public function zila(){
        return $this->belongsTo('App\Models\Zila', 'zila_id');
    }

    public function upazila(){
        return $this->belongsTo('App\Models\Upazila', 'upazila_id');
    }

}
