@extends('frontend.layouts.app')
<title>Payment History - {{ config('app.name', 'Laravel') }}</title>
@section('content')


    <section class="page_title ls s-py-50 corner-title ls invise overflow-visible">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>{{ $project->name }}</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" style="font-size: 20px">
                            Total Budget: {{ $project->project_budget }} TAKA
                        </li>
                        <li class="breadcrumb-item active" style="color: green;font-size: 20px">
                            Total Pay: {{ $project->total_pay }} TAKA
                        </li>
                        <li class="breadcrumb-item active" style="color: red;font-size: 20px">
                            Total Due: {{ $project->total_due }} TAKA
                        </li>
                    </ol>

                    <br>

                    @if($project->project_budget != $project->total_pay)

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#PaymentModal"
                        style="padding: 10px 25px;color:white">
                        Pay Now
                    </button>
                    
                    @endif





                    <div class="divider-15 d-none d-xl-block"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="ls s-pt-50 s-pb-100 s-pb-lg-130 shop-account-orders">


        <div class="container">

            <div class="row">

                <div class="d-none d-lg-block divider-65"></div>

                <main class="col-lg-12">



                    <article id="post-1708" class="post-1708 page type-page status-publish hentry">
                        <div class="entry-content">
                            <div class="woocommerce">
                                @include('client.components.sidebar')

                                <div class="woocommerce-MyAccount-content">



                                    @if (count($histories) > 0)
                                        <table
                                            class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
                                            <thead>
                                                <tr>

                                                    <th
                                                        class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number">
                                                        <span class="nobr">#</span>
                                                    </th>

                                                    <th
                                                        class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number">
                                                        <span class="nobr">Date</span>
                                                    </th>

                                                    <th
                                                        class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number">
                                                        <span class="nobr">Amount</span>
                                                    </th>

                                                    <th
                                                        class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number">
                                                        <span class="nobr">Note</span>
                                                    </th>
                                                    <th
                                                        class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number">
                                                        <span class="nobr">TRX ID</span>
                                                    </th>


                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach ($histories as $key => $item)
                                                    <tr
                                                        class="woocommerce-orders-table__row woocommerce-orders-table__row--status-processing order ">
                                                        <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number first"
                                                            data-title="Order">
                                                            {{ $key + 1 }}

                                                        </td>
                                                        <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number first"
                                                            data-title="Order">
                                                            {{ $item->date }}

                                                        </td>
                                                        <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-date"
                                                            data-title="Date">
                                                            {{ $item->pay }}

                                                        </td>
                                                        <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-status"
                                                            data-title="Status">
                                                            {{ $item->note }}
                                                        </td>
                                                        <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-total"
                                                            data-title="Total">
                                                            {{ $item->bank_trx_id ?? 'Office Payment' }}
                                                        </td>


                                                    </tr>
                                                @endforeach



                                            </tbody>
                                        </table>
                                    @else
                                        <div
                                            class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
                                            
                                            No payment has been made yet.

                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#PaymentModal" style="padding: 10px 25px;color:white">
                                                Pay Now
                                            </button>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <!-- .entry-content -->
                    </article>

                </main>

                <div class="d-none d-lg-block divider-55"></div>
            </div>

        </div>
    </section>
    <!-- Modal -->




    <form class="woocomerce-form woocommerce-form-login login form-control1"
        action="{{ route('client.make-online-payment') }}" method="get">
        @csrf


        <div class="modal fade" id="PaymentModal" tabindex="-1" role="dialog" aria-labelledby="PaymentModalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle" style="font-size: 20px">Make Payment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <input type="hidden" name="project_id" value="{{ $project->id }}" required>


                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="due">Total Due
                            </label>
                            <input type="number" autocomplete="off"
                                class="woocommerce-Input woocommerce-Input--text input-text" name="due" id="due"
                                placeholder="Due" value="@php if ($project['total_due'] == 0) { echo $project->project_budget; } else { echo $project->total_due; } @endphp" readonly>
                        </p>

                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="payamount"> Pay Amount
                            </label>
                            <input type="number" autocomplete="off"
                                class="woocommerce-Input woocommerce-Input--text input-text" name="pay_amount"
                                id="payamount" placeholder="Pay Amount" min="500" required>
                        </p>

                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="income_expense_categories"> Payment Type
                            </label>

                            <select name="income_expense_category_id"
                                class="woocommerce-Input woocommerce-Input--text input-text" id="" required>
                                <option value="">Select</option>

                                @foreach ($income_expense_categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach

                            </select>
                        </p>

                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="payment_method"> Payment Method
                            </label>

                            <select name="payment_method" class="woocommerce-Input woocommerce-Input--text input-text"
                                id="" required>
                                <option value="">Select</option>
                                <option value="Bkash">Bkash</option>
                                <option value="Shurjopay">Shurjopay</option>
                                <option value="Paypal">Paypal</option>
                                <option value="Stripe">Stripe</option>
                            </select>
                        </p>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"
                            style="padding: 10px 25px;color:white">Close</button>
                        <button type="submit" class="btn btn-primary" style="padding: 10px 25px;">Pay Now</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
