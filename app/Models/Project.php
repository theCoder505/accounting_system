<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

	public function admin(){
		return $this->belongsTo('App\Models\Admin', 'admin_id');
	}

	public function category(){
		return $this->belongsTo('App\Models\Category', 'category_id');
	}

	public function company(){
		return $this->belongsTo('App\Models\Company', 'company_id');
	}

	public function technology(){
		return $this->belongsTo('App\Models\Technology', 'technology_id');
	}




}
