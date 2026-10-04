<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncomeExpense;
use App\Models\IncomeExpenseCategory;
use App\Models\IncomeExpenseHistory;
use App\Models\Project;
use App\Models\Transaction;
use App\Models\StripeTempPayment;
use Carbon\Carbon;

class StripePaymentController extends Controller
{
    public function success(Request $request, $pay_amount, $project_id, $income_expense_category_id)
    {
        $project = Project::where('id', $project_id)->first();

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $tem_data = StripeTempPayment::where('project_id', $project_id)->where('income_expense_category_id', $income_expense_category_id)->first();

        $session = \Stripe\Checkout\Session::retrieve($tem_data->session_id);

        if ($session->payment_status == 'paid') {

            $income_expense = IncomeExpense::where('project_id', $project->id)->where('company_id', $project->company_id)->first();
            if ($income_expense) {
                $data = IncomeExpense::find($income_expense->id);
                $data->admin_id = 1;
                $data->type = 'Income';
                $data->date = Carbon::now()->format('y-m-d');
                $data->income_expense_category_id = $income_expense_category_id;
                $data->company_id = $project->company_id;
                $data->project_id = $project->id;
                $data->title = $project->name . ' Payment';


                $data->amount = $data->amount + $pay_amount;
                $data->due = $data->total - $data->amount;

                if ($data->due > 0) {
                    $data->status = 0;
                } else {
                    $data->status = 1;
                }

                $data->save();
            } else {
                $data = new IncomeExpense();
                $data->admin_id = 1;
                $data->type = 'Income';
                $data->date = Carbon::now()->format('y-m-d');
                $data->income_expense_category_id = $income_expense_category_id;
                $data->company_id = $project->company_id;
                $data->project_id = $project->id;
                $data->title = $project->name . ' Payment';


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

            $history->method = 'Stripe';
            $history->order_id = $session->payment_intent;
            $history->bank_trx_id = $session->payment_intent;
            $history->customer_order_id = $session->payment_intent;

            $history->total = $data->amount;
            $history->pay = $pay_amount;
            $history->due = $data->due;
            $history->note = 'Stripe Payment';
            $history->save();


            $trx = new Transaction();
            $trx->type = $data->type;
            $trx->title = $category->name;
            $trx->year = date('Y');
            $trx->month = date('F');
            $trx->company_id = $data->company_id ?? null;
            $trx->project_id = $data->project_id ?? null;
            $trx->amount = $pay_amount;
            $trx->note = 'Stripe Payment';
            $trx->save();

            if ($data->type == 'Income' && $data->project_id) {
                $project = Project::where('id', $data->project_id)->first();
                Project::where('id', $data->project_id)->update([
                    'total_pay' => $project->total_pay + $pay_amount,
                    'total_due' => $data->due,
                ]);
            }

            StripeTempPayment::where('session_id', $tem_data->session_id)->delete();

            flash()->addSuccess('Your payment is successful !');
            return redirect()->route('client.projects');
        }
    }
}
