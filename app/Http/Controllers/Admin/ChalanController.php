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
use App\Models\Sell;
use App\Models\SellProduct;
use App\Models\Company;
use App\Models\Siteinfo;
use App\Models\SiteImage;
use App\Models\Chalan;
use App\Models\ChalanProduct;
use Str;
use Session;
use PDF;
use NumberFormatter;


class ChalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chalans = Chalan::orderBy('id', 'desc')->get();
        $companies = Company::where('status', 1)->get();

        return view('admin.chalan.index', compact('chalans', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('status', 1)->get();
        $companies = Company::where('status', 1)->get();
        $chalan = Chalan::count();
        
        $default = 1500;
        $next = $default + 1;
        
        $total_chalan = date('Y').$next;
        return view('admin.chalan.create', compact('products', 'companies', 'total_chalan'));
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
            'company_id' => 'required',
            'date' => 'required',
            'total' => 'required',
        ]);

        $product_id = $request->product_id;
        $product_code = $request->product_code;
        $order_qty = $request->order_qty;
        $remarks = $request->remarks;

        foreach ($product_id as $key => $value) {
            $product = Product::where('id', $value)->first();

            $data = new Chalan();
            $data->invoice_id = $request->invoice_id;
            $data->company_id = $request->company_id;
            $data->date = $request->date;
            $data->delivery_site = $request->delivery_site;
            $data->project_name = $request->project_name;
            $data->sale_ref = $request->sale_ref;
            $data->contact = $request->contact;
            $data->total = $request->total;
            $data->save();

            foreach ($product_id as $key => $value) {
                $product = new ChalanProduct();
                $product->chalan_id = $data->id;
                $product->product_id = $value;
                $product->order_qty = $order_qty[$key];
                $product->remarks = $remarks[$key];
                $product->save();
            }   


            $notification=array(
                'message' => 'Saved Successfully !!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

          
        }
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
        $data = Chalan::find($id);
        $chalan_products = ChalanProduct::where('chalan_id', $id)->get();

        $products = Product::where('status', 1)->get();
        $companies = Company::where('status', 1)->get();

        $chalan = Chalan::count();
        $total_chalan = date('Y').$chalan + rand(0, 999) + 1;

        return view('admin.chalan.edit', compact('products', 'total_chalan', 'data', 'chalan_products', 'companies'));
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

        $product_id = $request->product_id;
        $product_code = $request->product_code;
        $order_qty = $request->order_qty;
        $remarks = $request->remarks;

        foreach ($product_id as $key => $value) {

            $product = Product::where('id', $value)->first();

            $data = Chalan::find($id);
            $data->invoice_id = $request->invoice_id;
            $data->company_id = $request->company_id;
            $data->date = $request->date;
            $data->delivery_site = $request->delivery_site;
            $data->project_name = $request->project_name;
            $data->sale_ref = $request->sale_ref;
            $data->contact = $request->contact;
            $data->total = $request->total;
            $data->save();

            $chalan_products = ChalanProduct::where('chalan_id', $id)->delete();

            foreach ($product_id as $key => $value) {
                $product = new ChalanProduct();
                $product->chalan_id = $data->id;
                $product->product_id = $value;
                $product->order_qty = $order_qty[$key];
                $product->remarks = $remarks[$key];
                $product->save();
            }   


            $notification=array(
                'message' => 'Update Successfully !!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data = Chalan::find($id);
        $data->delete();

        $products = ChalanProduct::where('chalan_id', $id)->delete();

        $notification=array(
            'message' => 'Deleted Done',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

    }

    public function filter_chalan(Request $request)
    {
        $site_info = Siteinfo::first();

        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $company_id = $request->company_id;


        $chalans = Chalan::orderBy('id','desc')
        ->where(function($filter) use ($from_date, $to_date, $company_id) {
               if (!empty($from_date) || $from_date != '') {
                   $filter->where('date', '>=' , $from_date);
               }
               if (!empty($to_date) || $to_date != '') {
                   $filter->where('date', '<=' , $to_date);
               }
               if (!empty($company_id) || $company_id != '') {
                   $filter->where('company_id', $company_id);
               }
             })
        ->get();

        $companies = Company::where('status', 1)->get();


        // $pdf = PDF::loadView('admin.chalan.chalan_report', compact('from_date', 'to_date', 'chalans', 'site_info', 'company_id', 'companies'))->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->stream('invoice.pdf');


       return view('admin.chalan.chalan_report', compact('from_date', 'to_date', 'chalans', 'site_info', 'company_id', 'companies'));

    }

    public function invoice($id)
    {
        $image = SiteImage::first();
        $site_info = Siteinfo::first();

        $data = Chalan::where('id', $id)->first();
        $products = ChalanProduct::where('chalan_id', $id)->get();

        $number = $data->total - $data->discount;
        $locale = 'en_US';
        $fmt = numfmt_create($locale, NumberFormatter::SPELLOUT);
        $total_text = numfmt_format($fmt, $number);


        $pdf = PDF::loadView('admin.chalan.invoice', compact('products', 'data', 'image', 'site_info', 'total_text'));
        return $pdf->stream($data->invoice_id.'_'.'chalan.pdf');
        // return view('admin.chalan.invoice', compact('products', 'data', 'image', 'site_info', 'total_text'));
    }

    public function getProducts($search)
    {
        $products = Product::where('name', 'like', '%' . $search . '%')->get();

        return view('admin.chalan.get_product', compact('products'));

        return response()->json($products);
    }

    public function getProductDetails($productId)
    {
        $product = Product::where('id', $productId)->first();

        return response([
            'product' => $product,
        ]);
        
    }

}
