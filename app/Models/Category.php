<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

	public function parent(){
		return $this->belongsTo('App\Models\Category', 'parent_id');
	}
	public function admin(){
		return $this->belongsTo('App\Models\Admin', 'admin_id');
	}

}
