<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\IncomeExpense;
use App\Models\MonthlyCollection;
use App\Models\Product;
use App\Models\Project;
use App\Models\Sell;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Str;
use App\Models\Transaction;



class TransactionController extends Controller
{
    public function all_transaction(){
        $datas = Transaction::get();
        $categories = Category::where('status', 1)->get();
        $companies = Company::where('status', 1)->get();
        return view('admin.transaction.index', compact('datas', 'categories', 'companies'));
    }

    public function filter_transaction(Request $request){


        $type = $request->type;
        $filter_year = $request->year;
        $filter_month = $request->month;
        $company_id = $request->company_id;
        $project_id = $request->project_id;

        $datas = Transaction::orderBy('id','desc')
        ->where(function($filter) use ($type, $company_id, $filter_year, $project_id, $filter_month) {
           
                if (!empty($type) || $type != '') {
                    $filter->where('type' , $type);
                }
             
                if (!empty($company_id) || $company_id != '') {
                    $filter->where('company_id' , $company_id);
                }

                if (!empty($project_id) || $project_id != '') {
                    $filter->where('project_id' , $project_id);
                }

                if (!empty($filter_year) || $filter_year != '') {
                    $filter->where('year' , $filter_year);
                }

                if (!empty($filter_month) || $filter_month != '') {
                    $filter->where('month' , $filter_month);
                }

             })
        ->get();

        $categories = Category::where('status', 1)->get();
        $companies = Company::where('status', 1)->get();
        $projects = Project::where('status', 1)->get();


       return view('admin.transaction.filter_transaction', compact('datas', 'type', 'project_id', 'filter_year', 'categories', 'company_id', 'projects', 'companies', 'filter_month'));
   }

   public function ledger(){

        $total_income = Transaction::where('type', 'Income')->sum('amount');
        $total_expense = Transaction::where('type', 'Expense')->sum('amount');

        $income_trxs = Transaction::where('type', 'Income')->orderBy('year', 'desc')->get();
        $groupedIncomeTrxs = $income_trxs->groupBy('title');

        
        $expense_trxs = Transaction::where('type', 'Expense')->orderBy('year', 'desc')->get();

        $years = Transaction::pluck('year');
        $uniqueYears = collect($years)->unique()->values()->all();

        $profit = 0;
        $profits = [];
        foreach ($uniqueYears as $key => $value) {

            $array_total_income = Transaction::where('type', 'Income')->where('year', $value)->sum('amount');
            $array_total_expense = Transaction::where('type', 'Expense')->where('year', $value)->sum('amount');

            $profit = $array_total_income - $array_total_expense;

            $profits[] = [
                'year' => $value,
                'month' => $value,
                'profit' => $profit,
            ];

            
        }


        return view('admin.accounts.ledger', compact('total_income', 'total_expense', 'income_trxs', 'expense_trxs', 'profit', 'profits'));
   }

   public function filter_ledger(Request $request){

        $filter_year = $request->year;
        $filter_month = $request->month;

        $total_income = Transaction::where(function($filter) use ($filter_year, $filter_month) {
                if (!empty($filter_year) || $filter_year != '') {
                    $filter->where('year' , $filter_year);
                }
                if (!empty($filter_month) || $filter_month != '') {
                    $filter->where('month' , $filter_month);
                }
            })
        ->where('type', 'Income')
        ->sum('amount');

        
        $total_expense = Transaction::where(function($filter) use ($filter_year, $filter_month) {
                if (!empty($filter_year) || $filter_year != '') {
                    $filter->where('year' , $filter_year);
                }
                if (!empty($filter_month) || $filter_month != '') {
                    $filter->where('month' , $filter_month);
                }
            })
        ->where('type', 'Expense')
        ->sum('amount');


        $income_trxs = Transaction::where(function($filter) use ($filter_year, $filter_month) {
                if (!empty($filter_year) || $filter_year != '') {
                    $filter->where('year' , $filter_year);
                }
                if (!empty($filter_month) || $filter_month != '') {
                    $filter->where('month' , $filter_month);
                }
            })
        ->where('type', 'Income')
        ->get();

        
        $expense_trxs = Transaction::where(function($filter) use ($filter_year, $filter_month) {
                if (!empty($filter_year) || $filter_year != '') {
                    $filter->where('year' , $filter_year);
                }
                if (!empty($filter_month) || $filter_month != '') {
                    $filter->where('month' , $filter_month);
                }
            })
        ->where('type', 'Expense')
        ->get();


        $profit = $total_income - $total_expense;


        return view('admin.accounts.filter_ledger', compact('total_income', 'total_expense', 'income_trxs', 'expense_trxs', 'profit', 'filter_year', 'filter_month'));

   }



}
