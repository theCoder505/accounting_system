<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Admin;
use Str;
use Session;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
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

        $categories = Category::orderBy('serial_no', 'asc')->get();
        return view('admin.category.index',compact('categories', 'admin'));
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

        $adminId = Session::get('adminId');
        
        $data = new Category();
        $data->admin_id=$adminId;
        $data->name=$request->name;
        $data->slug = Str::slug($request->name);
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
        $categories = Category::all();
        $data = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('data', 'categories'));
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
        $adminId = Session::get('adminId');

        $data = Category::find($id);
        $data->admin_id=$adminId;
        $data->serial_no=$request->serial_no;
        $data->name=$request->name;
        $data->slug=Str::slug($request->name);
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


        Category::where('id', $id)->delete();
    
        
        $notification=array(
            'message' => 'Category Deleted Successfully !!',
            'alert-type' => 'error'
        );
        
        return redirect()->back()->with($notification);

    }
}
