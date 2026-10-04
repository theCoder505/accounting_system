<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\IncomeExpenseCategory;
use App\Models\IncomeExpenseHistory;
use App\Models\Project;
use App\Models\SiteSocialLink;
use App\Models\StripeTempPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;
use shurjopayv2\ShurjopayLaravelPackage8\Http\Controllers\ShurjopayController;
use Stripe;


class ClientController extends Controller
{
    public function login()
    {

        $clientId = Session::get('clientId');
        if ($clientId) {
            return redirect()->route('client.dashboard');
        }

        return view('client.auth.login');
    }
    public function submit_login(Request $request)
    {
        $phone = $request->phone;
        $password = $request->password;

        $client = Company::where('phone', $phone)->first();

        if ($client) {
            $existingPassword = $client->password;
            if (password_verify($request->password, $existingPassword)) {

                Session::put('clientId', $client->id);
                flash()->addSuccess('Login successful !');

                return redirect()->route('client.dashboard');
            } else {
                flash()->addError('Phone number or password is wrong !');
                return redirect()->back();
            }
        } else {
            flash()->addError('Phone number or password is wrong !');
            return redirect()->back();
        }
    }

    public function account_details()
    {

        $clientId = Session::get('clientId');
        if ($clientId) {
            $client = Company::where('id', $clientId)->first();
            return view('client.account_details', compact('client'));
        } else {
            return view('client.login');
        }
    }

    public function dashboard()
    {

        $clientId = Session::get('clientId');
        if ($clientId) {
            $client = Company::where('id', $clientId)->first();
            return view('client.dashboard', compact('client'));
        } else {
            return view('client.login');
        }
    }

    public function logout()
    {
        Session::forget('clientId');
        flash()->addSuccess('Logout successful !');
        return redirect()->route('client.login');
    }

    public function projects()
    {
        $clientId = Session::get('clientId');
        if ($clientId) {
            $client = Company::where('id', $clientId)->first();
            $projects = Project::where('company_id', $client->id)->orderBy('id', 'desc')->get();
            $social_link = SiteSocialLink::first();
            return view('client.projects', compact('client', 'projects', 'social_link'));
        } else {
            return view('client.login');
        }
    }

    public function make_payment($id)
    {
        $clientId = Session::get('clientId');
        if ($clientId) {
            $client = Company::where('id', $clientId)->first();
            $project = Project::where('id', $id)->first();

            $histories = IncomeExpenseHistory::where('project_id', $project->id)->orderBy('id', 'asc')->get();

            $social_link = SiteSocialLink::first();

            $income_expense_categories = IncomeExpenseCategory::where('type', 'Income')->get();

            return view('client.make_payment', compact('client', 'project', 'social_link', 'histories', 'income_expense_categories'));
        } else {
            return redirect()->route('client.login');
        }
    }

    public function make_online_payment(Request $request)
    {

        $validated = $request->validate([
            'pay_amount' => 'required',
            'payment_method' => 'required',
            'income_expense_category_id' => 'required',
        ]);

        $clientId = Session::get('clientId');
        if (!$clientId) {
            return redirect()->route('client.login');
        }

        $client = Company::where('id', $clientId)->first();

        $pay_amount = $request->pay_amount;
        $payment_method = $request->payment_method;
        $project_id = $request->project_id;
        $income_expense_category_id = $request->income_expense_category_id;

        if ($payment_method == 'Shurjopay') {
            $info = array(
                'currency' => "BDT",
                'amount' => $pay_amount,
                'order_id' => uniqid(),
                'discsount_amount' => 0,
                'disc_percent' => 0,
                'client_ip' => "127:0:1:0",
                'customer_name' => $client->name,
                'customer_phone' => $client->phone,
                'email' => $client->email ?? '',
                'customer_address' => $client->address,
                'customer_city' => 'NA',
                'customer_state' => 'NA',
                'customer_postcode' => "0000",
                'customer_country' => "Bangladesh",
                'tran_id' => uniqid(),
                'value1' => $project_id,
                'value2' => $income_expense_category_id,

            );

            $shurjopay_service = new ShurjopayController();
            return $shurjopay_service->checkout($info);
        }

        if ($payment_method == 'Bkash') {

            $inv = uniqid();
            $request['intent'] = 'sale';
            $request['mode'] = '0011'; //0011 for checkout
            $request['payerReference'] = $inv;
            $request['currency'] = 'BDT';
            $request['amount'] = $pay_amount;
            $request['merchantInvoiceNumber'] = $inv;
            $request['callbackURL'] = config("bkash.callbackURL");;

            $request_data_json = json_encode($request->all());

            $response =  BkashPaymentTokenize::cPayment($request_data_json);

            if (isset($response['bkashURL'])) return redirect()->away($response['bkashURL']);
            else return redirect()->back()->with('error-alert2', $response['statusMessage']);
        }


        if ($payment_method == 'Paypal') {


            return redirect()->route('make.payment', ['pay_amount' => $pay_amount, 'project_id' => $project_id, 'income_expense_category_id' => $income_expense_category_id]);
        }


        if ($payment_method == 'Stripe') {

            $project = Project::where('id', $project_id)->first();

            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $session = \Stripe\Checkout\Session::create([
                'line_items' => [
                    [
                        'price_data' => [
                            'product_data' => [
                                'name' => $project->name,
                            ],
                            'unit_amount' => 100 * $pay_amount,
                            'currency' => 'USD',
                        ],
                        'quantity' => 1
                    ],
                ],
                'mode'        => 'payment',
                'success_url' => route('stripe.success', ['pay_amount' => $pay_amount, 'project_id' => $project_id, 'income_expense_category_id' => $income_expense_category_id]),
                'cancel_url'  => route('cancel.payment'),
            ]);

            $temp_payment = new StripeTempPayment();
            $temp_payment->session_id = $session->id;
            $temp_payment->project_id = $project_id;
            $temp_payment->company_id = $project->company_id;
            $temp_payment->income_expense_category_id = $income_expense_category_id;
            $temp_payment->save();

            $redirectUrl = route('stripe.success', ['session_id' => '{CHECKOUT_SESSION_ID}', 'pay_amount' => $pay_amount, 'project_id' => $project_id, 'income_expense_category_id' => $income_expense_category_id]);

            return redirect()->away($session->url);
        }
    }
}
