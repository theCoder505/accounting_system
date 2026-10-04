<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyCollection extends Model
{
    use HasFactory;

    public function company(){
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function admin(){
        return $this->belongsTo('App\Models\Admin', 'admin_id');
    }

}
