<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\IncomeExpense;
use App\Models\IncomeExpenseCategory;
use App\Models\IncomeExpenseHistory;
use App\Models\Project;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Str;
use Exception;
use Twilio\Rest\Client;

class IncomeExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = IncomeExpense::orderBy('id', 'desc')->get();

        $categories = IncomeExpenseCategory::where('status', 1)->get();
        $companies = Company::where('status', 1)->get();

        return view('admin.income_expense.index', compact('datas', 'categories', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = IncomeExpenseCategory::where('status', 1)->get();
        $companies = Company::where('status', 1)->get();
        $projects = Project::where('status', 1)->get();
        return view('admin.income_expense.create', compact('categories', 'companies', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin_id = Session::get('adminId');

        $project_data_exist = IncomeExpense::where('income_expense_category_id', $request->income_expense_category_id)->where('company_id', $request->company_id)->where('project_id', $request->project_id)->first();
        if($project_data_exist){
            return redirect()->route('income_expense.edit', ['income_expense' => $project_data_exist->id]);
        }

        $data = new IncomeExpense();
        $data->admin_id = $admin_id;
        $data->type = $request->type;
        $data->date = Carbon::now()->format('Y-m-d');
        $data->income_expense_category_id = $request->income_expense_category_id;
        $data->company_id = $request->company_id;
        $data->project_id = $request->project_id;
        $data->title = $request->title;


        $data->total = $request->total;
        $data->amount = $request->amount;
        $data->due = $request->due;

        if ($request->due > 0) {
            $data->status = 0;
        } else {
            $data->status = 1;
        }

        $data->save();

        $category = IncomeExpenseCategory::where('id', $request->income_expense_category_id)->first();

        $history = new IncomeExpenseHistory();
        $history->income_expense_id = $data->id;
        $history->type = $request->type;
        $history->date = Carbon::now()->format('Y-m-d');
        $history->income_expense_category_id = $request->income_expense_category_id;
        $history->company_id = $request->company_id;
        $history->project_id = $request->project_id;

        
        $history->total = $request->total;
        $history->pay = $request->amount;
        $history->due = $request->due;
        $history->note = $request->note;
        
        $history->save();


        $trx = new Transaction();
        $trx->type = $request->type;
        $trx->title = $category->name;
        $trx->year = date('Y');
        $trx->month = date('F');
        $trx->company_id = $request->company_id ?? null;
        $trx->project_id = $request->project_id ?? null;
        $trx->amount = $request->amount;
        $trx->note = $request->note;
        $trx->save();

        if($request->type == 'Income' && $request->project_id){
            $project = Project::where('id', $request->project_id)->first();
            Project::where('id', $request->project_id)->update([
                'total_pay' => $project->total_pay + $request->amount,
                'total_due' => $request->due,
            ]);
        }


        $notification = array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = IncomeExpense::where('id', $id)->first();
        $histories = IncomeExpenseHistory::where('income_expense_id', $data->id)->orderBy('id', 'asc')->get();

        return view('admin.income_expense.show', compact('data', 'histories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = IncomeExpense::find($id);

        $categories = IncomeExpenseCategory::where('status', 1)->get();
        $companies = Company::where('status', 1)->get();
        $projects = Project::where('status', 1)->get();
        return view('admin.income_expense.edit', compact('categories', 'companies', 'data', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data = IncomeExpense::find($id);
        $data->type = $request->type;
        $data->date = Carbon::now()->format('Y-m-d');
        $data->income_expense_category_id = $request->income_expense_category_id;
        $data->company_id = $request->company_id;
        $data->project_id = $request->project_id;
        $data->title = $request->title;

        $data->amount = $data->amount + $request->pay_now;
        $data->due = $request->due;

        if ($request->due > 0) {
            $data->status = 0;
        } else {
            $data->status = 1;
        }
        $data->save();

        $category = IncomeExpenseCategory::where('id', $request->income_expense_category_id)->first();

        $history = new IncomeExpenseHistory();
        $history->income_expense_id = $data->id;
        $history->type = $request->type;
        $history->date = Carbon::now()->format('Y-m-d');
        $history->income_expense_category_id = $request->income_expense_category_id;
        $history->company_id = $request->company_id;
        $history->project_id = $request->project_id;

        $history->total = $data->due;
        $history->pay = $request->pay_now;
        $history->due = $request->due;
        $history->note = $request->note;
        $history->save();


        $trx = new Transaction();
        $trx->type = $request->type;
        $trx->title = $category->name;
        $trx->year = date('Y');
        $trx->month = date('F');
        $trx->company_id = $request->company_id ?? null;
        $trx->project_id = $request->project_id ?? null;
        $trx->amount = $request->pay_now;
        $trx->note = $request->note;
        $trx->save();


        if($request->type == 'Income' && $request->project_id){
            $project = Project::where('id', $request->project_id)->first();
            Project::where('id', $request->project_id)->update([
                'total_pay' => $project->total_pay + $request->pay_now,
                'total_due' => $request->due,
            ]);
        }

        $notification = array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get_category_details(Request $request)
    {
        $category = Category::where('id', $request->category_id)->first();

        return response([
            'category' => $category,
        ]);
    }

    public function filter_income_expense(Request $request)
    {


        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $company_id = $request->company_id;
        $type = $request->type;
        $income_expense_category_id = $request->income_expense_category_id;
        $status = $request->status;

        $datas = IncomeExpense::orderBy('id', 'desc')
            ->where(function ($filter) use ($from_date, $to_date, $type, $company_id, $income_expense_category_id, $status) {
                if (!empty($from_date) || $from_date != '') {
                    $filter->where('date', '>=', $from_date);
                }
                if (!empty($to_date) || $to_date != '') {
                    $filter->where('date', '<=', $to_date);
                }
                if (!empty($type) || $type != '') {
                    $filter->where('type', $type);
                }
                if (!empty($company_id) || $company_id != '') {
                    $filter->where('company_id', $company_id);
                }
                if (!empty($income_expense_category_id) || $income_expense_category_id != '') {
                    $filter->where('income_expense_category_id', $income_expense_category_id);
                }
                if (!empty($status) || $status != '') {
                    $filter->where('status', $status);
                }
            })
            ->get();

        $categories = IncomeExpenseCategory::where('status', 1)->get();
        $companies = Company::where('status', 1)->get();



        return view('admin.income_expense.filter_income_expense', compact('datas', 'from_date', 'to_date', 'company_id', 'companies', 'type', 'income_expense_category_id', 'status', 'categories'));
    }

    public function get_projects(Request $request)
    {

        $projects = Project::where('company_id', $request->company_id)->where('status', 1)->get();

        return view('admin.income_expense.get_projects', compact('projects'));
    }

    public function get_ie_category(Request $request)
    {

        $categories = IncomeExpenseCategory::where('type', $request->type)->where('status', 1)->get();

        return view('admin.income_expense.get_ie_category', compact('categories'));
    }

    public function get_project_details(Request $request)
    {
        $project = Project::where('id', $request->project_id)->first();

        return response([
            'project' => $project,
        ]);
    }
}
