<?php

namespace App\Http\Controllers;

use App\Models\IncomeExpense;
use App\Models\IncomeExpenseCategory;
use App\Models\IncomeExpenseHistory;
use App\Models\Project;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;

class BkashTokenizePaymentController extends Controller
{
    public function index()
    {
        return view('bkashT::bkash-payment');
    }
    public function createPayment(Request $request)
    {
        $inv = uniqid();
        $request['intent'] = 'sale';
        $request['mode'] = '0011'; //0011 for checkout
        $request['payerReference'] = $inv;
        $request['currency'] = 'BDT';
        $request['amount'] = 10;
        $request['merchantInvoiceNumber'] = $inv;
        $request['callbackURL'] = config("bkash.callbackURL");;

        $request_data_json = json_encode($request->all());

        $response =  BkashPaymentTokenize::cPayment($request_data_json);
        //$response =  BkashPaymentTokenize::cPayment($request_data_json,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..

        //store paymentID and your account number for matching in callback request
        // dd($response) //if you are using sandbox and not submit info to bkash use it for 1 response

        if (isset($response['bkashURL'])) return redirect()->away($response['bkashURL']);
        else return redirect()->back()->with('error-alert2', $response['statusMessage']);
    }

    public function callBack(Request $request)
    {
        //callback request params
        // paymentID=your_payment_id&status=success&apiVersion=1.2.0-beta
        //using paymentID find the account number for sending params

        if ($request->status == 'success'){
            $response = BkashPaymentTokenize::executePayment($request->paymentID);
            //$response = BkashPaymentTokenize::executePayment($request->paymentID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            if (!$response){ //if executePayment payment not found call queryPayment
                $response = BkashPaymentTokenize::queryPayment($request->paymentID);
                //$response = BkashPaymentTokenize::queryPayment($request->paymentID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            }

            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                /*
                 * for refund need to store
                 * paymentID and trxID
                 * */

                 $data = new IncomeExpense();
                 $data->type = 'Income';
                 $data->date = Carbon::now()->format('y-m-d');
                 $data->income_expense_category_id = $request->income_expense_category_id;
                 $data->company_id = $request->company_id;
                 $data->project_id = $request->project_id;
                 $data->title = $request->title;
         
         
                 $data->total = $request->total;
                 $data->amount = $request->amount;
                 $data->due = $request->due;
         
                 if ($request->due > 0) {
                     $data->status = 0;
                 } else {
                     $data->status = 1;
                 }
         
                 $data->save();
         
                 $category = IncomeExpenseCategory::where('id', $request->income_expense_category_id)->first();
         
                 $history = new IncomeExpenseHistory();
                 $history->income_expense_id = $data->id;
                 $history->type = $request->type;
                 $history->date = Carbon::now()->format('Y-m-d');
                 $history->income_expense_category_id = $request->income_expense_category_id;
                 $history->company_id = $request->company_id;
                 $history->project_id = $request->project_id;
         
                 
                 $history->total = $request->total;
                 $history->pay = $request->amount;
                 $history->due = $request->due;
                 $history->note = $request->note;
                 $history->save();
         
         
                 $trx = new Transaction();
                 $trx->type = $request->type;
                 $trx->title = $category->name;
                 $trx->year = date('Y');
                 $trx->month = date('F');
                 $trx->company_id = $request->company_id ?? null;
                 $trx->project_id = $request->project_id ?? null;
                 $trx->amount = $request->amount;
                 $trx->note = $request->note;
                 $trx->save();
         
                 if($request->type == 'Income' && $request->project_id){
                     $project = Project::where('id', $request->project_id)->first();
                     Project::where('id', $request->project_id)->update([
                         'total_pay' => $project->total_pay + $request->amount,
                         'total_due' => $request->due,
                     ]);
                 }



                return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
            }
            return BkashPaymentTokenize::failure($response['statusMessage']);
        }else if ($request->status == 'cancel'){
            return BkashPaymentTokenize::cancel('Your payment is canceled');
        }else{
            return BkashPaymentTokenize::failure('Your transaction is failed');
        }
    }

    public function searchTnx($trxID)
    {
        //response
        return BkashPaymentTokenize::searchTransaction($trxID);
        //return BkashPaymentTokenize::searchTransaction($trxID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }

    public function refund(Request $request)
    {
        $paymentID='Your payment id';
        $trxID='your transaction no';
        $amount=5;
        $reason='this is test reason';
        $sku='abc';
        //response
        return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku);
        //return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
    public function refundStatus(Request $request)
    {
        $paymentID='Your payment id';
        $trxID='your transaction no';
        return BkashRefundTokenize::refundStatus($paymentID,$trxID);
        //return BkashRefundTokenize::refundStatus($paymentID,$trxID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
}
