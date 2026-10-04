<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\MonthlyCollection;
use App\Models\MonthlyCollectionMonths;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;



class MonthlyCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = MonthlyCollection::orderBy('id', 'desc')->get();
        $companies = Company::where('status', 1)->get();
        return view('admin.monthly_collection.index', compact('datas', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::where('status', 1)->get();
        return view('admin.monthly_collection.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'company_id' => 'required',
            'per_month_amount' => 'required',
            'year' => 'required',
            'month.*' => 'required',
            'date.*' => 'required',
        ]);

        $adminId = Session::get('adminId');

        $exist = MonthlyCollection::where('company_id', $request->company_id)->where('year', $request->year)->first();
        if ($exist) {
            $notification = array(
                'message' => 'Already created record. you can edit now',
                'alert-type' => 'error'
            );
            return redirect('admin/monthly_collection/' . $exist->id . '/edit')->with($notification);
        }


        $month = $request->month;
        $duplicates = array_unique(array_diff_assoc($month, array_unique($month)));
        if (!empty($duplicates)) {
            $notification = array(
                'message' => 'The following months are repeated:' . implode(", ", $duplicates),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $year = $request->year;
        $last_year = $year - 1;

        $is_completed = MonthlyCollection::where('company_id', $request->company_id)->where('year', $last_year)->first();


        $data = new MonthlyCollection();
        $data->admin_id = $adminId;
        $data->date = date('Y-m-d');
        $data->company_id = $request->company_id;
        $data->per_month_amount = $request->per_month_amount;
        $data->year = $request->year;
        $data->total_month = count($request->month);
        $data->total_pay = $request->total;
        $data->total_due = $request->due;

        if ($request->due > 0) {
            $data->status = 0;
        } else {
            $data->status = 1;
        }

        $data->save();

        $amount = $request->amount;
        $date = $request->date;
        if ($month && count($month) > 0) {
            foreach ($month as $key => $value) {
                if ($value) {
                    $months = new MonthlyCollectionMonths();
                    $months->monthly_collection_id = $data->id;
                    $months->month = $value;
                    $months->amount = $amount[$key];
                    $months->date = $date[$key];
                    $months->save();
                }
            }
        }

        $trx = new Transaction();
        $trx->type = 'Income';
        $trx->title = 'monthly_collection';
        $trx->year = $request->year;
        $trx->company_id = $request->company_id;
        $trx->amount = $request->total;
        $trx->save();

        if ($is_completed && $is_completed->total_month != 12) {
            $due_month = 12 - $is_completed->total_month;
            $notification = array(
                'message' => 'You have due ' . $due_month . ' Months of ' . $last_year,
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Successfully Done',
                'alert-type' => 'success'
            );
        }

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data = MonthlyCollection::where('id', $id)->first();
        $months = MonthlyCollectionMonths::where('monthly_collection_id', $id)->get();

        $companies = Company::where('status', 1)->get();
        return view('admin.monthly_collection.edit', compact('companies', 'data', 'months'));
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

        $exist = MonthlyCollection::where('company_id', $request->company_id)->where('year', $request->year)->first();

        $month = $request->month;
        $duplicates = array_unique(array_diff_assoc($month, array_unique($month)));
        if (!empty($duplicates)) {
            $notification = array(
                'message' => 'The following months are repeated:' . implode(", ", $duplicates),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $data = MonthlyCollection::find($id);
        $data->company_id = $request->company_id;
        $data->per_month_amount = $request->per_month_amount;
        $data->year = $request->year;
        $data->total_month = count($request->month);
        $data->total_pay = $request->total;
        $data->total_due = $request->due;

        if ($request->due > 0) {
            $data->status = 0;
        } else {
            $data->status = 1;
        }

        $data->save();



        $amount = $request->amount;
        $date = $request->date;
        if ($month && count($month) > 0) {
            $months = MonthlyCollectionMonths::where('monthly_collection_id', $id)->delete();
            foreach ($month as $key => $value) {
                if ($value) {
                    $months = new MonthlyCollectionMonths();
                    $months->monthly_collection_id = $data->id;
                    $months->month = $value;
                    $months->amount = $amount[$key];
                    $months->date = $date[$key];
                    $months->save();
                }
            }
        }

        $trx = new Transaction();
        $trx->type = 'Income';
        $trx->title = 'monthly_collection';
        $trx->year = $request->year;
        $trx->company_id = $request->company_id;
        $trx->amount = $request->total - $exist->total_pay;
        $trx->save();

        $notification = array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function filter_monthly_collection(Request $request)
    {


        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $company_id = $request->company_id;
        $filter_year = $request->year;


        $datas = MonthlyCollection::orderBy('id', 'desc')
            ->where(function ($filter) use ($from_date, $to_date, $filter_year, $company_id) {
                if (!empty($from_date) || $from_date != '') {
                    $filter->where('created_at', '>=', $from_date);
                }
                if (!empty($to_date) || $to_date != '') {
                    $filter->where('created_at', '<=', $to_date);
                }
                if (!empty($filter_year) || $filter_year != '') {
                    $filter->where('year', $filter_year);
                }
                if (!empty($company_id) || $company_id != '') {
                    $filter->where('company_id', $company_id);
                }
            })
            ->get();

        $companies = Company::where('status', 1)->get();

        return view('admin.monthly_collection.filter_monthly_collection', compact('datas', 'from_date', 'to_date', 'filter_year', 'company_id', 'companies'));
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
}
