<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function company(){
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function project(){
        return $this->belongsTo('App\Models\Project', 'project_id');
    }


}
