<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Company;
use App\Models\Project;
use App\Models\Siteinfo;
use App\Models\Technology;
use Str;
use Session;

class ProjectController extends Controller
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

        $projects = Project::orderBy('id', 'desc')->get();

        $companies = Company::where('status', 1)->orderBy('id', 'desc')->get();
        $categories = Category::where('status', 1)->orderBy('id', 'desc')->get();
        $technologies = Technology::where('status', 1)->orderBy('id', 'desc')->get();

        return view('admin.project.index', compact('projects', 'admin', 'companies', 'categories', 'technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $companies = Company::where('status', 1)->orderBy('id', 'desc')->get();
        $categories = Category::where('status', 1)->orderBy('id', 'desc')->get();
        $technologies = Technology::where('status', 1)->orderBy('id', 'desc')->get();

        return view('admin.project.create', compact('companies', 'categories', 'technologies'));
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

        $data = new Project();
        $data->admin_id = $adminId;
        $data->company_id = $request->company_id;
        $data->name = $request->name;
        $data->project_budget = $request->project_budget;
        $data->total_pay = 0;
        $data->total_due = 0;
        $data->technology_id = $request->technology_id;
        $data->category_id = $request->category_id;
        $data->start_date = $request->start_date;
        $data->delivery_date = $request->delivery_date;
        $data->domain_name = $request->domain_name;
        $data->domain_expire_date = $request->domain_expire_date;
        $data->admin_details_entry = $request->admin_details_entry;
        $data->status = $request->status;
        $data->save();


        
        $notification = array(
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
        $data = Project::where('id', $id)->first();

        $companies = Company::where('status', 1)->orderBy('id', 'desc')->get();
        $categories = Category::where('status', 1)->orderBy('id', 'desc')->get();
        $technologies = Technology::where('status', 1)->orderBy('id', 'desc')->get();

        return view('admin.project.edit', compact('companies', 'categories', 'technologies', 'data'));
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

        $data = Project::find($id);
        $data->admin_id = $adminId;
        $data->company_id = $request->company_id;
        $data->name = $request->name;
        $data->project_budget = $request->project_budget;
        $data->technology_id = $request->technology_id;
        $data->category_id = $request->category_id;
        $data->start_date = $request->start_date;
        $data->delivery_date = $request->delivery_date;
        $data->domain_name = $request->domain_name;
        $data->domain_expire_date = $request->domain_expire_date;
        $data->admin_details_entry = $request->admin_details_entry;
        $data->status = $request->status;
        $data->save();
        $notification = array(
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
        $data = Project::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Successfully Done',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    public function filter_project(Request $request)
    {
        $site_info = Siteinfo::first();

        $company_id = $request->company_id;
        $category_id = $request->category_id;
        $technology_id = $request->technology_id;
        $name = $request->name;
       
        $start_date = $request->start_date;
        $delivery_date = $request->delivery_date;

        $projects = Project::orderBy('id', 'desc')
            ->where(function ($filter) use ($company_id, $category_id, $technology_id, $name, $start_date, $delivery_date) {
                if (!empty($company_id) || $company_id != '') {
                    $filter->where('company_id', $company_id);
                }
                if (!empty($category_id) || $category_id != '') {
                    $filter->where('category_id', $category_id);
                }
                if (!empty($technology_id) || $technology_id != '') {
                    $filter->where('technology_id', $technology_id);
                }
                if (!empty($name) || $name != '') {
                    $filter->where('name', '%'. $name .'%');
                }
                if (!empty($start_date) || $start_date != '') {
                    $filter->where('start_date', '>=', $start_date);
                }
                if (!empty($delivery_date) || $delivery_date != '') {
                    $filter->where('delivery_date', '<=', $delivery_date);
                }
            })
            ->get();


            $companies = Company::where('status', 1)->orderBy('id', 'desc')->get();
            $categories = Category::where('status', 1)->orderBy('id', 'desc')->get();
            $technologies = Technology::where('status', 1)->orderBy('id', 'desc')->get();

        return view('admin.project.filter_project', compact('company_id', 'category_id', 'technology_id', 'name', 'start_date', 'delivery_date', 'companies', 'projects', 'categories', 'technologies'));
    }



}
