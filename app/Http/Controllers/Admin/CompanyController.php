<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Str;
use Session;

class CompanyController extends Controller
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

        $companies = Company::all();
        
        $total_companies = Company::count();
        // $total_companies = date('Y').$total_companies + rand(0, 99) + 1;
        $default = 1501;
        $next = $default + 1;
    
        $total_companies = date('Y').$next;
        
        return view('admin.company.index',compact('companies', 'admin', 'total_companies'));
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

        $adminId = Session::get('adminId');

        $data = new Company();
        $data->admin_id=$adminId;
        $data->name=$request->name;

        $data->occupation=$request->occupation;
        $data->phone=$request->phone;
        $data->address=$request->address;
        $data->password=Hash::make($request->password);
        $data->password_str=$request->password;

        $data->status=$request->status;

        $image = $request->file('image');
        if($image)
        {
            $image_name= uniqid().'_'.$image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/company/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if($success)
            {
                $data->image = $image_url;
            }
        }


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
        $data = Company::where('id',$id)->first();
        return view('admin.company.edit',compact('data'));
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

        $data = Company::find($id);
        $data->admin_id=$adminId;
        $data->name=$request->name;
        $data->occupation=$request->occupation;
        $data->phone=$request->phone;
        $data->address=$request->address;
        $data->status=$request->status;
        $data->password=Hash::make($request->password);
        $data->password_str=$request->password;
        
        $image = $request->file('image');
        if($image)
        {
            $image_name= uniqid().'_'.$image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/company/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if($success)
            {
                $data->image = $image_url;
            }
        }


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
        $data = Company::find($id);
        $data->delete();
        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
