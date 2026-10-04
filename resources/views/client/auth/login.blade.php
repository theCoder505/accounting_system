@extends('frontend.layouts.app')
<title>Client Login - {{ config('app.name', 'Laravel') }}</title>
@section('content')


    <section class="page_title ls s-py-50 corner-title ls invise overflow-visible">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Account - Login</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{URL::to('/')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Client - Login
                        </li>
                    </ol>
                    <div class="divider-15 d-none d-xl-block"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="ls s-pt-50 s-pb-100 shop_account_login">
        <div class="container">
            <div class="row">

                <div class="d-none d-lg-block divider-65"></div>

                <main class="col-lg-12">
                    <article class="text-center">
                        <div class="entry-content">
                            <div class="woocommerce">

                                <form class="woocomerce-form woocommerce-form-login login form-control1" action="{{route('client.submit_login')}}" method="post">
                                    @csrf
                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                        <label for="phone">
                                        </label>
                                        <input type="number" autocomplete="off" class="woocommerce-Input woocommerce-Input--text input-text"
                                            name="phone" id="phone" placeholder="Phone number" value>
                                    </p>
                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                        <label for="password">
                                        </label>
                                        <input class="woocommerce-Input woocommerce-Input--text input-text" type="text"  autocomplete="off"
                                            name="password" placeholder="Password" id="password">
                                    </p>

                                    <p class="form-row">
                                        <input type="submit" class="woocommerce-Button button" name="login"
                                            value="Login">
                                      
                                    </p>

                                </form>
                            </div>
                        </div>
                    </article>

                </main>

                <div class="d-none d-lg-block divider-95"></div>
            </div>

        </div>
    </section>

@stop
