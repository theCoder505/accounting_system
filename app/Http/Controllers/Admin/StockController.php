<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Product;
use App\Models\Admin;
use App\Models\Stock;
use App\Models\StockHistory;
use App\Models\SubCategory;
use App\Models\Brand;
use Str;
use Session;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::get();
        $categories = Category::where('status', 1)->get();
        $products  = Product::where('status', 1)->get();
        $units = Unit::where('status', 1)->get();

        return view('admin.stock.index', compact('stocks', 'categories', 'units', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('status', 1)->get();
        return view('admin.stock.create', compact('products'));
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
            'product_id' => 'required',
            'qty' => 'required',
            'date' => 'required',
        ]);

        $adminId = Session::get('adminId');

        $product = Product::where('id', $request->product_id)->first();
        $stock = Stock::where('product_id', $request->product_id)->first();
     
        $data = new Stock();
        $data->admin_id=$adminId;
        $data->product_id = $request->product_id;
        $data->available_qty = $product->qty;
        $data->buying_price = $request->buying_price;
        $data->qty = $request->qty;
        $data->total_qty = $product->qty + $request->qty;
        $data->date = $request->date;
        $data->save();

        // $history = new StockHistory();
        // $history->stock_id = $data->id ?? $stock->id;
        // $history->available_qty = $product->qty;
        // $history->qty = $request->qty;
        // $history->total_qty = $product->qty + $request->qty;
        // $history->total_sell = 0;
        // $history->save();

        Product::where('id', $request->product_id)->update([
            'qty' => $request->qty + $product->qty,
        ]);

        $notification=array(
            'message' => 'Saved Successfully !!',
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
        $data = Stock::find($id);
        $product = Product::where('id', $data->product_id)->first();
        $products = Product::where('status', 1)->get();
        return view('admin.stock.edit', compact('products', 'data', 'product'));
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
        $product = Product::where('id', $request->product_id)->first();

        $data = Stock::find($id);
        $data->admin_id=$adminId;
        $data->product_id = $request->product_id;
        $data->available_qty = $request->available_qty;
        $data->buying_price = $request->buying_price;
        $data->qty = $request->qty;
        $data->total_qty = $request->available_qty + $request->qty;
        $data->date = $request->date;
        $data->save();

        Product::where('id', $request->product_id)->update([
            'qty' => $request->qty + $request->available_qty,
        ]);

        $notification=array(
            'message' => 'Updated Successfully !!',
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
        //
    }

    public function get_product_details(Request $request)
    {
        $product = Product::where('id', $request->product_id)->first();

        return response([
            'product' => $product,
        ]);
    }

   public function filter_stock(Request $request){

        $categories = Category::where('status', 1)->get();
        $units = Unit::where('status', 1)->get();
        $products  = Product::where('status', 1)->get();

        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $product_id = $request->product_id;
      // $unit_id = $request->unit_id;

        $datas = Stock::orderBy('id','desc')
        ->where(function($filter) use ($from_date, $to_date,  $product_id) {
                if (!empty($from_date) || $from_date != '') {
                   $filter->where('created_at', '>=' , $from_date);
                }
                if (!empty($to_date) || $to_date != '') {
                   $filter->where('created_at', '<=' , $to_date);
                }
            
                if (!empty($product_id) || $product_id != '') {
                    $filter->where('product_id' , $product_id);
                }
             })
        ->get();

       return view('admin.stock.filter_stock',compact('datas', 'from_date', 'to_date', 'categories', 'units', 'product_id', 'products'));
   }





}
