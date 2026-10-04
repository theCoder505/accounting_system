<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\AdminPermission;
use Hash;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::get();
        return view('admin.role.index', compact('roles'));
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
            'title' => 'required',
        ]);

        $data = new Role();
        $data->title=$request->title;
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
        $data = Role::where('id',$id)->first();
        return view('admin.role.edit',compact('data'));
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
        $data = Role::find($id);
        $data->title=$request->title;
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
        $data = Role::find($id);
        $data->delete();

        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

    }

    public function add_permission()
    {
        $roles = Role::where('status', 1)->get();
        return view('admin.role.add_permission', compact('roles'));
    }

    public function submit_permission(Request $request)
    {
        $validatedData = $request->validate([
            'role_id' => 'required',
        ]);

        $existData = AdminPermission::where('role_id', $request->role_id)->first();

        if($existData){
            $data = AdminPermission::find($existData->id);
            $data->role_id = $request->role_id;
            $data->dashboard = $request->dashboard ?? 'off';
            $data->category_create = $request->category_create ?? 'off';
            $data->category_edit = $request->category_edit ?? 'off';
            $data->category_delete = $request->category_delete ?? 'off';
            $data->tag_create = $request->tag_create ?? 'off';
            $data->tag_edit = $request->tag_edit ?? 'off';
            $data->tag_delete = $request->tag_delete ?? 'off';
            $data->subject_create = $request->subject_create ?? 'off';
            $data->subject_edit = $request->subject_edit ?? 'off';
            $data->subject_delete = $request->subject_delete ?? 'off';
            $data->banner_create = $request->banner_create ?? 'off';
            $data->banner_edit = $request->banner_edit ?? 'off';
            $data->banner_delete = $request->banner_delete ?? 'off';
            $data->post_create = $request->post_create ?? 'off';
            $data->post_edit = $request->post_edit ?? 'off';
            $data->post_delete = $request->post_delete ?? 'off';
            $data->website_settings = $request->website_settings ?? 'off';
            $data->save();
        }else{
            $data = new AdminPermission();
            $data->role_id = $request->role_id;
            $data->dashboard = $request->dashboard ?? 'off';
            $data->category_create = $request->category_create ?? 'off';
            $data->category_edit = $request->category_edit ?? 'off';
            $data->category_delete = $request->category_delete ?? 'off';
            $data->tag_create = $request->tag_create ?? 'off';
            $data->tag_edit = $request->tag_edit ?? 'off';
            $data->tag_delete = $request->tag_delete ?? 'off';
            $data->subject_create = $request->subject_create ?? 'off';
            $data->subject_edit = $request->subject_edit ?? 'off';
            $data->subject_delete = $request->subject_delete ?? 'off';
            $data->banner_create = $request->banner_create ?? 'off';
            $data->banner_edit = $request->banner_edit ?? 'off';
            $data->banner_delete = $request->banner_delete ?? 'off';
            $data->post_create = $request->post_create ?? 'off';
            $data->post_edit = $request->post_edit ?? 'off';
            $data->post_delete = $request->post_delete ?? 'off';
            $data->website_settings = $request->website_settings ?? 'off';
            $data->save();
        }
        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function edit_permission($id)
    {
        $roles = Role::where('status', 1)->get();
        $data = AdminPermission::where('role_id', $id)->first();
        if($data){
            return view('admin.role.edit_permission', compact('roles', 'data'));
        }else{
            return view('admin.role.add_permission', compact('roles', 'id'));
        }
    }

    public function update_permission(Request $request, $id)
    {
        $data = AdminPermission::find($id);
        $data->role_id = $request->role_id;
        $data->dashboard = $request->dashboard ?? 'off';
        $data->category_create = $request->category_create ?? 'off';
        $data->category_edit = $request->category_edit ?? 'off';
        $data->category_delete = $request->category_delete ?? 'off';
        $data->tag_create = $request->tag_create ?? 'off';
        $data->tag_edit = $request->tag_edit ?? 'off';
        $data->tag_delete = $request->tag_delete ?? 'off';
        $data->subject_create = $request->subject_create ?? 'off';
        $data->subject_edit = $request->subject_edit ?? 'off';
        $data->subject_delete = $request->subject_delete ?? 'off';
        $data->banner_create = $request->banner_create ?? 'off';
        $data->banner_edit = $request->banner_edit ?? 'off';
        $data->banner_delete = $request->banner_delete ?? 'off';
        $data->post_create = $request->post_create ?? 'off';
        $data->post_edit = $request->post_edit ?? 'off';
        $data->post_delete = $request->post_delete ?? 'off';
        $data->website_settings = $request->website_settings ?? 'off';
        $data->save();

        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

}
