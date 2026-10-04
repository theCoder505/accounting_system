<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;

    public function company(){
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function chalan(){
        return $this->belongsTo('App\Models\Chalan', 'chalan_id');
    }

    public function admin(){
        return $this->belongsTo('App\Models\Admin', 'admin_id');
    }


}
