<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Service;
use Illuminate\Support\Facades\Hash;
use Str;
use Session;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Service::get();
        return view('admin.service.index',compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.create');
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

        $data = new Service();
        $data->name=$request->name;
        $data->slug=Str::slug($request->name);
        $data->short_description=$request->short_description;
        $data->description=$request->description;
        $data->status=$request->status;

        $image = $request->file('image');
        if($image)
        {
            $image_name= uniqid().'_'.$image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/service/';
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
        $data = Service::where('id',$id)->first();
        return view('admin.service.edit',compact('data'));
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

        $data = Service::find($id);
        $data->name=$request->name;
        $data->slug=Str::slug($request->name);
        $data->short_description=$request->short_description;
        $data->description=$request->description;
        $data->status=$request->status;
        
        $image = $request->file('image');
        if($image)
        {
            $image_name= uniqid().'_'.$image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/service/';
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
        $data = Service::find($id);
        $data->delete();
        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
