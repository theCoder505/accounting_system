<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Siteinfo;
use Str;
use Session;
use PDF;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::where('status', 1)->get();
        return view('admin.product.create');
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
            'name' => 'required | unique:products',
            'selling_price' => 'required',
        ]);

        $adminId = Session::get('adminId');


        $data = new Product();
        $data->admin_id=$adminId;
        $data->name = $request->name;
        $data->selling_price = $request->selling_price;
        $data->qty = $request->qty;
        $data->status = $request->status;
        $data->save();

        $notification=array(
            'message' => 'Product Saved Successfully !!',
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
        $data = Product::find($id);
        return view('admin.product.edit', compact('data'));
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

        $data = Product::find($id);
        $data->admin_id=$adminId;
        $data->name = $request->name;
        $data->qty = $request->qty;
        $data->status = $request->status;
        $data->save();

        $notification=array(
            'message' => 'Post Saved Successfully !!',
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

        Product::where('id', $id)->delete();
        
        $notification=array(
            'message' => 'Deleted Successfully !!',
            'alert-type' => 'error'
        );
        
        return redirect()->back()->with($notification);
    }


   public function filter_product(Request $request){

        $site_info = Siteinfo::first();

        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $products = Product::orderBy('id','desc')
        ->where(function($filter) use ($from_date, $to_date) {
               if (!empty($from_date) || $from_date != '') {
                   $filter->where('created_at', '>=' , $from_date);
               }
               if (!empty($to_date) || $to_date != '') {
                   $filter->where('created_at', '<=' , $to_date);
               }

             })
        ->get();


        // $pdf = PDF::loadView('admin.product.filter_product', compact('from_date', 'to_date', 'products', 'site_info'))->setOptions(['defaultFont' => 'sans-serif']);;
        // return $pdf->stream('invoice.pdf');

    //    return view('admin.sell.filter_sell', compact('products', 'from_date', 'to_date'));
   }









}
