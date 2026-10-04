<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Session;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Review::get();
        return view('admin.review.index',compact('datas'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.review.create');

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

        $data = new Review();
        $data->designation=$request->designation;
        $data->short_description=$request->short_description;
        $data->name=$request->name;
        $data->date=$request->date;
        $data->status=$request->status;

        $image = $request->file('image');
        if($image)
        {
            $image_name= uniqid().'_'.$image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/review/';
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
        $data = Review::where('id',$id)->first();
        return view('admin.review.edit',compact('data'));
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

        $data = Review::find($id);
        $data->designation=$request->designation;
        $data->short_description=$request->short_description;
        $data->name=$request->name;
        $data->date=$request->date;
        $data->status=$request->status;
        
        $image = $request->file('image');
        if($image)
        {
            $image_name= uniqid().'_'.$image->getClientOriginalName();
            $image_full_name = $image_name;
            $upload_path = 'images/review/';
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
        $data = Review::find($id);
        $data->delete();
        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
