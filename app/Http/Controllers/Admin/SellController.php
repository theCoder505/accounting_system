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
use App\Models\Transaction;
use Str;
use Session;
use PDF;
use NumberFormatter;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sells = Sell::orderBy('id', 'desc')->get();
        $companies = Company::where('status', 1)->get();
        return view('admin.sell.index', compact('sells', 'companies'));
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
        $chalans = Chalan::get();

        $sell = Sell::count();
        $total_sell = date('Y').$sell + rand(0, 999) + 1;

        return view('admin.sell.create', compact('products', 'total_sell', 'companies', 'chalans'));
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
            'status' => 'required',
            'total' => 'required',
            'date' => 'required',
            'payment_method' => 'required',
        ]);

        $adminId = Session::get('adminId');

        $product_id = $request->product_id;
        $qty = $request->qty;
        $unit_price = $request->unit_price;
        $amount = $request->amount;
        $discount_percentage = $request->discount_percentage;
        $discount = $request->discount;
        $subtotal = $request->subtotal;
        

        foreach ($product_id as $key => $value) {
            $product = Product::where('id', $value)->first();
            if($product->qty >= $qty[$key]){


                $data = new Sell();
                $data->admin_id=$adminId;
                $data->date = $request->date;
                $data->company_id = $request->company_id;
                $data->invoice_id = uniqid();



                $data->total = $request->tttt_total;
                $data->discount_percentage = $request->discount_percentage;
                $data->total_discount_amount = $request->total_discount_amount;
                $data->pay = $request->pay;
                $data->due = $request->due ?? 0;


                $data->payment_method = $request->payment_method;
                $data->delivery_note = $request->delivery_note;
                $data->supplier_ref = $request->supplier_ref;
                $data->other_ref = $request->other_ref;
                $data->status = $request->status;
                $data->save();

                foreach ($product_id as $key => $value) {
                    $product = new SellProduct();
                    $product->sell_id = $data->id;
                    $product->product_id = $value;
                    $product->qty = $qty[$key];
                    $product->unit_price = $unit_price[$key];
                    $product->amount = $amount[$key];
                    $product->subtotal = $subtotal[$key];
                    $product->save();

                    if($request->status == 'Completed'){

                        $product = Product::where('id', $value)->first();

                        $available_qty = $product->qty - $qty[$key]; //230
                        $total_sell = $product->total_sell + $qty[$key]; // 30

                        $total_qty = $available_qty + $total_sell; // 260

                        Product::where('id', $value)->update([
                            'qty' => $available_qty,
                            'total_sell' => $total_sell,
                            'total_qty' => $total_qty,
                        ]);
                    }
                }   

                $trx = new Transaction();
                $trx->type = 'Income';
                $trx->title = 'book_sell';
                $trx->year = date('Y');
                $trx->month = date('m');
                $trx->company_id = $request->company_id;
                $trx->amount = $request->pay;
                $trx->save();

                $notification=array(
                    'message' => 'Saved Successfully !!',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);

            }else{
                $notification=array(
                    'message' => 'Insufficient Product !!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
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
        $data = Sell::find($id);
        $sell_products = SellProduct::where('sell_id', $id)->get();

        $products = Product::where('status', 1)->get();
        $companies = Company::where('status', 1)->get();

        $sell = Sell::count();
        $total_sell = date('Y').$sell + rand(0, 999) + 1;

        $chalans = Chalan::get();
        return view('admin.sell.edit', compact('products', 'total_sell', 'data', 'sell_products', 'companies', 'chalans'));
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
        $qty = $request->qty;
        $unit_price = $request->unit_price;
        $amount = $request->amount;
        $discount = $request->discount;
        $discount_percentage = $request->discount_percentage;
        $subtotal = $request->subtotal;

        $chalan = Chalan::where('id', $request->chalan_id)->first();

        foreach ($product_id as $key => $value) {
            $product = Product::where('id', $value)->first();
            if($product->qty >= $qty[$key]){

                $data = Sell::find($id);
                $data->date = $request->date;
                $data->chalan_id = $request->chalan_id;
                $data->company_id = $request->company_id;
                $data->invoice_id = $chalan->invoice_id;

                
                $data->total = $request->tttt_total;
                $data->discount_percentage = $request->discount_percentage;
                $data->total_discount_amount = $request->total_discount_amount;
                $data->pay = $request->pay;
                $data->due = $request->due ?? 0;


                $data->payment_method = $request->payment_method;
                $data->delivery_note = $request->delivery_note;
                $data->supplier_ref = $request->supplier_ref;
                $data->other_ref = $request->other_ref;
                $data->status = $request->status;
                $data->save();


                $sell_products = SellProduct::where('sell_id', $id)->delete();
                foreach ($product_id as $key => $value) {
                    $product = new SellProduct();
                    $product->sell_id = $data->id;
                    $product->product_id = $value;
                    $product->qty = $qty[$key];
                    $product->unit_price = $unit_price[$key];
                    $product->amount = $amount[$key];
                    $product->subtotal = $subtotal[$key];
                    $product->save();

                    if($request->status == 'Completed'){

                        $product = Product::where('id', $value)->first();

                        $available_qty = $product->qty - $qty[$key]; //230
                        $total_sell = $product->total_sell + $qty[$key]; // 30

                        $total_qty = $available_qty + $total_sell; // 260

                        Product::where('id', $value)->update([
                            'qty' => $available_qty,
                            'total_sell' => $total_sell,
                            'total_qty' => $total_qty,
                        ]);
                    }
                }


                $notification=array(
                    'message' => 'Saved Successfully !!',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);

            }else{
                $notification=array(
                    'message' => 'Insufficient Product !!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
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
        $data = Sell::find($id);
        $data->delete();

        $sell_products = SellProduct::where('sell_id', $id)->delete();


        $notification=array(
            'message' => 'Deleted Done',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }


   public function filter_sell(Request $request){

        $site_info = Siteinfo::first();

        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $status = $request->status;


        $company_id = $request->company_id;


        $datas = Sell::orderBy('id','desc')
        ->where(function($filter) use ($from_date, $to_date, $status, $company_id) {
               if (!empty($from_date) || $from_date != '') {
                   $filter->where('created_at', '>=' , $from_date);
               }
               if (!empty($to_date) || $to_date != '') {
                   $filter->where('created_at', '<=' , $to_date);
               }
               if (!empty($status) || $status != '') {
                   $filter->where('status' , $status);
               }
               if (!empty($company_id) || $company_id != '') {
                $filter->where('company_id' , $company_id);
            }

             })
        ->get();


        if(count($datas) > 0){
            $pdf = PDF::loadView('admin.sell.sell_report', compact('from_date', 'to_date', 'datas', 'site_info', 'company_id'))->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->stream('invoice.pdf');
        }else{
            $notification=array(
                'message' => 'Data not found !',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }



       // return view('admin.sell.filter_sell', compact('datas', 'from_date', 'to_date', 'status'));
   }

    public function get_company_details(Request $request)
    {
        $company = Company::where('id', $request->company_id)->first();

        return response([
            'company' => $company,
        ]);
    }

    public function invoice($id){
        $image = SiteImage::first();
        $site_info = Siteinfo::first();

        $data = Sell::where('id', $id)->first();
        $products = SellProduct::where('sell_id', $id)->get();



        $number = $data->total + $data->pay;
        
           $no = floor($number);
           $point = round($number - $no, 2) * 100;
           $hundred = null;
           $digits_1 = strlen($no);
           $i = 0;
           $str = array();
           $words = array('0' => '', '1' => 'one', '2' => 'two',
            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
            '7' => 'seven', '8' => 'eight', '9' => 'nine',
            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
            '13' => 'thirteen', '14' => 'fourteen',
            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
            '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
            '60' => 'sixty', '70' => 'seventy',
            '80' => 'eighty', '90' => 'ninety');
            $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
            while ($i < $digits_1) {
             $divider = ($i == 2) ? 10 : 100;
             $number = floor($no % $divider);
             $no = floor($no / $divider);
             $i += ($divider == 10) ? 1 : 2;
             if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] .
                    " " . $digits[$counter] . $plural . " " . $hundred
                    :
                    $words[floor($number / 10) * 10]
                    . " " . $words[$number % 10] . " "
                    . $digits[$counter] . $plural . " " . $hundred;
            } else $str[] = null;
          }
          $str = array_reverse($str);
          $result = implode('', $str);
          $points = ($point) ?
            " " . $words[$point / 10] . " " . 
                  $words[$point = $point % 10] : '';
                  
        if($points == ''){
            $total_text = $result . "Taka";
        }else{
            $total_text = $result . "taka  " . $points . " poisha";  
        }
     


        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P', //L for landscape, P for potrait
            'defaultFont' => 'sans-serif',
            'margin_left' => '10',
            'margin_top' => '10',
            'margin_bottom' => '5',
            'margin_right' => '10',
        ]);
 
        $mpdf->showWatermarkImage = false;
        $mpdf->writeHTML(view('admin.sell.invoice', compact('products', 'data', 'image', 'site_info', 'total_text')));
        $mpdf->Output($data->invoice_id.'_'.'invoice.pdf', 'I');



        // $pdf = PDF::loadView('admin.sell.invoice', compact('products', 'data', 'image', 'site_info', 'total_text'));
        // return $pdf->stream($data->invoice_id.'_'.'invoice.pdf');
        // return view('admin.sell.invoice', compact('products', 'data', 'image', 'site_info', 'total_text'));
    }






}
