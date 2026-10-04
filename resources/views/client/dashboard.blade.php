@extends('frontend.layouts.app')
<title>Client Dashboard - {{ config('app.name', 'Laravel') }}</title>
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
                            Client - Dashboard
                        </li>
                    </ol>
                    <div class="divider-15 d-none d-xl-block"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="ls s-pt-50 s-pb-100">
        <div class="container">
            <div class="row">

                <div class="d-none d-lg-block divider-50"></div>

                <main class="col-lg-12">

                    <article>
                        <header class="entry-header">
                            <h1 class="entry-title">My account</h1>
                           
                        </header>
                        <!-- .entry-header -->
                        <div class="entry-content">
                            <div class="woocommerce">

                                @include('client.components.sidebar')

                                <div class="woocommerce-MyAccount-content">

                                    <p>Hello
                                        <strong>{{$client->name}}</strong>
                                    </p>

                                    <p>From your account dashboard you can view your
                                        <a href="shop-account-orders.html">recent orders</a>, manage your
                                        <a href="shop-account-address.html">shipping and billing
                                            addresses</a> and
                                        <a href="shop-account-details.html">edit your password and account
                                            details</a>.
                                    </p>

                                </div>
                            </div>
                        </div>
                        <!-- .entry-content -->
                    </article>

                </main>

                <div class="d-none d-lg-block divider-75"></div>
            </div>

        </div>
    </section>

@stop
