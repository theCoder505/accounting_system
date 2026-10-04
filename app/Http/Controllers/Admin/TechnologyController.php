<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;
use App\Models\Admin;
use Str;
use Session;
use Intervention\Image\Facades\Image;

class TechnologyController extends Controller
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

        $categories = Technology::orderBy('id', 'asc')->get();
        return view('admin.technology.index',compact('categories', 'admin'));
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
        
        $data = new Technology();
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
        $categories = Technology::all();
        $data = Technology::where('id',$id)->first();
        return view('admin.technology.edit',compact('data', 'categories'));
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

        $data = Technology::find($id);
        $data->admin_id=$adminId;
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


        Technology::where('id', $id)->delete();
    
        
        $notification=array(
            'message' => 'Technology Deleted Successfully !!',
            'alert-type' => 'error'
        );
        
        return redirect()->back()->with($notification);

    }
}
