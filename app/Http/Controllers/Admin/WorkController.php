<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Service;
use App\Models\Work;
use Illuminate\Support\Facades\Hash;
use Str;
use Session;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Work::get();
        $services = Service::where('status', 1)->get();
        return view('admin.work.index',compact('datas', 'services'));
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

        $data = new Work();
        $data->service_id=$request->service_id;
        $data->name=$request->name;
        $data->link=$request->link;
        $data->status=$request->status;

        $image = $request->file('image');
        if($image)
        {
            $image_name= uniqid().'_'.$image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/work/';
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
        $data = Work::where('id',$id)->first();
        $services = Service::where('status', 1)->get();
        return view('admin.work.edit',compact('data', 'services'));
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

        $data = Work::find($id);
        $data->service_id=$request->service_id;
        $data->name=$request->name;
        $data->link=$request->link;
        $data->status=$request->status;
        
        $image = $request->file('image');
        if($image)
        {
            $image_name= uniqid().'_'.$image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/work/';
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
        $data = Work::find($id);
        $data->delete();
        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
