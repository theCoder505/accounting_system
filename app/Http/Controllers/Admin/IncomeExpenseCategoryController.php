<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IncomeExpenseCategory;
use App\Models\Admin;
use Str;
use Session;
use Intervention\Image\Facades\Image;

class IncomeExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminId = Session::get('adminId');
        $admin = Admin::where('id', $adminId)->first();
        $categories = IncomeExpenseCategory::orderBy('id', 'asc')->get();
        return view('admin.income_expense_category.index',compact('categories', 'admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required',
        ]);

        $data = new IncomeExpenseCategory();
        $data->type=$request->type;
        $data->name=$request->name;
        $data->status=$request->status;

        $data->save();
        $notification=array(
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
        $data = IncomeExpenseCategory::where('id',$id)->first();
        return view('admin.income_expense_category.edit',compact('data'));
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
        

        $data = IncomeExpenseCategory::find($id);
        $data->type=$request->type;
        $data->name=$request->name;
        $data->status=$request->status;

        $data->save();
        $notification=array(
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

        IncomeExpenseCategory::where('id', $id)->delete();
        
        $notification=array(
            'message' => 'Category Deleted Successfully !!',
            'alert-type' => 'error'
        );
        
        return redirect()->back()->with($notification);

    }
}
