<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeExpense extends Model
{
    use HasFactory;

    public function company(){
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function project(){
        return $this->belongsTo('App\Models\Project', 'project_id');
    }


    public function income_expense_category(){
        return $this->belongsTo('App\Models\IncomeExpenseCategory', 'income_expense_category_id');
    }

	public function admin(){
		return $this->belongsTo('App\Models\Admin', 'admin_id');
	}



}
