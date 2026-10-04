@extends('frontend.layouts.app')
<title>Projects - {{ config('app.name', 'Laravel') }}</title>
@section('content')


    <section class="page_title ls s-py-50 corner-title ls invise overflow-visible">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Account</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ URL::to('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Client - Projects
                        </li>
                    </ol>
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




                                    @if (count($projects) > 0)
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
                                                        <span class="nobr">Title</span>
                                                    </th>

                                                    <th
                                                        class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number">
                                                        <span class="nobr">Budget</span>
                                                    </th>
                                                    <th
                                                        class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number">
                                                        <span class="nobr">Pay</span>
                                                    </th>
                                                    <th
                                                        class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number">
                                                        <span class="nobr">Due</span>
                                                    </th>
                                                    {{-- <th
                                                        class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number">
                                                        <span class="nobr">Payment Status</span>
                                                    </th> --}}
                                                    <th
                                                        class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number">
                                                        <span class="nobr">Make Payment </span>
                                                    </th>
                                                   

                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach($projects as $key=> $item)
                                                <tr
                                                    class="woocommerce-orders-table__row woocommerce-orders-table__row--status-processing order ">
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number first"
                                                        data-title="Order">
                                                        {{$key + 1}}

                                                    </td>
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number first"
                                                        data-title="Order">
                                                        {{$item->name}}

                                                    </td>
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-date"
                                                        data-title="Date">
                                                        {{$item->project_budget}}

                                                    </td>
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-status"
                                                        data-title="Status">

                                           
                                                        {{$item->total_pay}}
                                                    </td>
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-total"
                                                        data-title="Total">

                                                        @if($item->total_due == 0 && $item->project_budget != $item->total_pay)

                                                            {{$item->project_budget}}

                                                        @else

                                                            {{$item->total_due}}

                                                        @endif
                                                        
                                                    </td>
                                                    {{-- <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-total"
                                                        data-title="Total">

                                                    </td> --}}
                                                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-actions"
                                                        data-title="Actions">
                                                        <a href="{{ route('client.make-payment', $item->id) }}"
                                                            class="woocommerce-button button view">Payment</a>
                                                    </td>
                                                  
                                                </tr>
                                                @endforeach



                                            </tbody>
                                        </table>
                                    @else
                                        <div
                                            class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
                                            <a class="woocommerce-Button button" href="https://api.whatsapp.com/send/?phone=8801726532507&text&type=phone_number&app_absent=0" target="_blank">
                                                Order now </a>
                                            No order has been made yet.
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

@stop
