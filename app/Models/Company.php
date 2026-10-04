<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

	public function admin(){
		return $this->belongsTo('App\Models\Admin', 'admin_id');
	}


}
