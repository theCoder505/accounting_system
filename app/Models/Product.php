<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function subcategory(){
        return $this->belongsTo('App\Models\SubCategory', 'subcategory_id');
    }

    public function unit(){
        return $this->belongsTo('App\Models\Unit', 'unit_id');
    }
    
    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }
	public function admin(){
		return $this->belongsTo('App\Models\Admin', 'admin_id');
	}



}
