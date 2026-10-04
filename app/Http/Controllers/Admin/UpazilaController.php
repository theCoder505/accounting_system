<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Zila;
use App\Models\Upazila;
use Str;

class UpazilaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions = Division::where('status', 1)->get();
        $zilas = Zila::where('status', 1)->get();
        $upazilas = Upazila::all();

        return view('admin.upazila.index',compact('divisions', 'zilas', 'upazilas'));
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
        $data = new Upazila();
        $data->division_id=$request->division_id;
        $data->zila_id=$request->zila_id;
        $data->name=$request->name;
        $data->name_bn=$request->name_bn;
        $data->slug=Str::slug($request->name);
        $data->slug_bn=Str::slug($request->name_bn);
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
        $data = Upazila::where('id',$id)->first();
        $divisions = Division::where('status', 1)->get();
        $zilas = Zila::where('status', 1)->get();

        return view('admin.upazila.edit',compact('data', 'divisions', 'zilas'));
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
        $data = Upazila::find($id);
        $data->division_id=$request->division_id;
        $data->zila_id=$request->zila_id;
        $data->name=$request->name;
        $data->name_bn=$request->name_bn;
        $data->slug=Str::slug($request->name);
        $data->slug_bn=Str::slug($request->name_bn);
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
        $data = Upazila::find($id);
        $data->delete();
        $notification=array(
            'message' => 'Deleted Done',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
