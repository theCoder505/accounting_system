<?php

namespace App\Http\Controllers;

use App\Models\IncomeExpense;
use App\Models\IncomeExpenseCategory;
use App\Models\IncomeExpenseHistory;
use App\Models\Project;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use shurjopayv2\ShurjopayLaravelPackage8\Http\Controllers\ShurjopayController;

class ShurjopayPaymentController extends Controller
{



    public function verifyPayment(Request $request)
    {

        $order_id = $request->order_id;
        $shurjopay_service = new ShurjopayController(); 
        $data_res = $shurjopay_service->verify($order_id);

        $response = json_decode($data_res);

        
        if($response[0]->sp_code != 1000){
            return redirect('/cancel-url');
        }else{

            $project = Project::where('id', $response[0]->value1)->first();

            $income_expense = IncomeExpense::where('project_id', $project->id)->where('company_id', $project->company_id)->first();
            if($income_expense){
                $data = IncomeExpense::find($income_expense->id);
                $data->admin_id = 1;
                $data->type = 'Income';
                $data->date = Carbon::now()->format('y-m-d');
                $data->income_expense_category_id = $response[0]->value2;
                $data->company_id = $project->company_id;
                $data->project_id = $project->id;
                $data->title = $project->name.' Payment';

        
                $data->amount = $data->amount + $response[0]->amount;
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
                $data->income_expense_category_id = $response[0]->value2;
                $data->company_id = $project->company_id;
                $data->project_id = $project->id;
                $data->title = $project->name.' Payment';


                $data->total = $project->project_budget;
                $data->amount = $data->amount + $response[0]->amount;
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
            
            $history->method = $response[0]->method;
            $history->order_id = $response[0]->order_id;
            $history->bank_trx_id = $response[0]->bank_trx_id;
            $history->customer_order_id = $response[0]->customer_order_id;

            $history->total = $data->amount;
            $history->pay = $response[0]->amount;
            $history->due = $data->due;
            $history->note = $response[0]->method.' Payment';
            $history->save();
    
    
            $trx = new Transaction();
            $trx->type = $data->type;
            $trx->title = $category->name;
            $trx->year = date('Y');
            $trx->month = date('F');
            $trx->company_id = $data->company_id ?? null;
            $trx->project_id = $data->project_id ?? null;
            $trx->amount = $response[0]->amount;
            $trx->note = $response[0]->method.' Payment';
            $trx->save();
    
            if($data->type == 'Income' && $data->project_id){
                $project = Project::where('id', $data->project_id)->first();
                Project::where('id', $data->project_id)->update([
                    'total_pay' => $project->total_pay + $response[0]->amount,
                    'total_due' => $data->due,
                ]);
            }

            flash()->addSuccess('Your payment is successful !');
            return redirect()->route('client.projects');


        }

    }

    public function cancelPayemnt(){
        flash()->addError('Your payment is canceled !');
        return redirect()->route('client.projects');
    }



}
