<?php

namespace App\Http\Controllers;

use App\Models\IncomeExpense;
use App\Models\IncomeExpenseCategory;
use App\Models\IncomeExpenseHistory;
use App\Models\Project;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PaypalPaymentController extends Controller
{
    public function paypalHandle($pay_amount, $project_id, $income_expense_category_id)
    {

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success.payment', ['pay_amount' => $pay_amount,'project_id' => $project_id,'income_expense_category_id' => $income_expense_category_id]),
                "cancel_url" => route('cancel.payment'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $pay_amount,
                    ]
                ]
            ]
        ]);
        if (
            isset($response['id']) && $response['id'] != null
        ) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->back()
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()->back()->with(
                'error',
                $response['message'] ?? 'Something went wrong.'
            );
        }
    }

    public function paymentCancel(Request $request, $id)
    {
        flash()->addError('Your payment is canceled !');
        return redirect()->route('client.projects');

    }

    public function paymentSuccess(Request $request, $pay_amount, $project_id, $income_expense_category_id)
    {
        $project = Project::where('id', $project_id)->first();

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $transactionId = $response['id'];

            $income_expense = IncomeExpense::where('project_id', $project->id)->where('company_id', $project->company_id)->first();
            if($income_expense){
                $data = IncomeExpense::find($income_expense->id);
                $data->admin_id = 1;
                $data->type = 'Income';
                $data->date = Carbon::now()->format('y-m-d');
                $data->income_expense_category_id = $income_expense_category_id;
                $data->company_id = $project->company_id;
                $data->project_id = $project->id;
                $data->title = $project->name.' Payment';

        
                $data->amount = $data->amount + $pay_amount;
                $data->due = $data->total - $data->amount;
        
                if ($data->due > 0) {
                    $data->status = 0;
                } else {
                    $data->status = 1;
                }
        
                $data->save();
            }else{
                $data = new IncomeExpense();
                $data->admin_id = 1;
                $data->type = 'Income';
                $data->date = Carbon::now()->format('y-m-d');
                $data->income_expense_category_id = $income_expense_category_id;
                $data->company_id = $project->company_id;
                $data->project_id = $project->id;
                $data->title = $project->name.' Payment';


                $data->total = $project->project_budget;
                $data->amount = $data->amount + $pay_amount;
                $data->due = $data->total - $data->amount;
        
                if ($data->due > 0) {
                    $data->status = 0;
                } else {
                    $data->status = 1;
                }
        
                $data->save();
            }

    
            $category = IncomeExpenseCategory::where('id', $data->income_expense_category_id)->first();
    
            $history = new IncomeExpenseHistory();
            $history->income_expense_id = $data->id;
            $history->type = $data->type;
            $history->date = Carbon::now()->format('Y-m-d');
            $history->income_expense_category_id = $data->income_expense_category_id;
            $history->company_id = $data->company_id;
            $history->project_id = $data->project_id;
            
            $history->method = 'Paypal';
            $history->order_id = $transactionId;
            $history->bank_trx_id = $transactionId;
            $history->customer_order_id = $transactionId;

            $history->total = $data->amount;
            $history->pay = $pay_amount;
            $history->due = $data->due;
            $history->note = 'Paypal Payment';
            $history->save();
    
    
            $trx = new Transaction();
            $trx->type = $data->type;
            $trx->title = $category->name;
            $trx->year = date('Y');
            $trx->month = date('F');
            $trx->company_id = $data->company_id ?? null;
            $trx->project_id = $data->project_id ?? null;
            $trx->amount = $pay_amount;
            $trx->note = 'Paypal Payment';
            $trx->save();
    
            if($data->type == 'Income' && $data->project_id){
                $project = Project::where('id', $data->project_id)->first();
                Project::where('id', $data->project_id)->update([
                    'total_pay' => $project->total_pay + $pay_amount,
                    'total_due' => $data->due,
                ]);
            }
        

            flash()->addSuccess('Your payment is successful !');
            return redirect()->route('client.projects');

        } else {

            flash()->addSuccess($response['message'] ?? 'Something went wrong.');
            return redirect()->route('client.projects');

        }
    }


}
