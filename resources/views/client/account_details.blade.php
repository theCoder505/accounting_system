@extends('frontend.layouts.app')
<title>Account Details - {{ config('app.name', 'Laravel') }}</title>
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
                            Account Details
                        </li>
                    </ol>
                    <div class="divider-15 d-none d-xl-block"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="ls s-pt-50 s-pb-130 s-pb-lg-100 shop_account_edit">
        <div class="container">
            <div class="row">

                <div class="d-none d-lg-block divider-50"></div>

                <main class="col-lg-12">
                    <article>
                        <header class="entry-header">
                            <h1 class="entry-title">Account details</h1>
                           
                        </header>
                        <!-- .entry-header -->
                        <div class="entry-content">
                            <div class="woocommerce">
                                @include('client.components.sidebar')

                                <div class="woocommerce-MyAccount-content">

                                    <form class="woocommerce-EditAccountForm edit-account" method="post">

                                        <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text"
                                                name="name" value="{{$client->name}}" placeholder="First name" id="name"
                                                value>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
                                            <input type="text"
                                                class="woocommerce-Input woocommerce-Input--text input-text"
                                                name="phone" value="{{$client->phone}}"  id="phone" placeholder="Last name"
                                                value>
                                        </p>
                                        <div class="clear">

                                        </div>

                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                            <input type="email"
                                                class="woocommerce-Input woocommerce-Input--email input-text"
                                                name="address" id="address" placeholder="Email address"
                                                value="{{$client->address}}">
                                        </p>

                                        <fieldset style="display: none">
                                            <h1 class="entry-title">Password change</h1>

                                            <p
                                                class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                <input type="password"
                                                    class="woocommerce-Input woocommerce-Input--password input-text"
                                                    name="password_current"
                                                    placeholder="Current password (leave blank to leave unchanged)"
                                                    id="password_current">
                                            </p>
                                            <p
                                                class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                <input type="password"
                                                    class="woocommerce-Input woocommerce-Input--password input-text"
                                                    name="password_1"
                                                    placeholder="New password (leave blank to leave unchanged)"
                                                    id="password_1">
                                            </p>
                                            <p
                                                class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                                <input type="password"
                                                    class="woocommerce-Input woocommerce-Input--password input-text"
                                                    name="password_2" placeholder="Confirm new password" id="password_2">
                                            </p>
                                        </fieldset>
                                        <div class="clear"></div>
                                        {{-- <p>
                                            <input type="submit" class="woocommerce-Button button"
                                                name="save_account_details" value="Save changes">
                                        </p> --}}
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- .entry-content -->
                    </article>

                </main>

                <div class="d-none d-lg-block divider-105"></div>
            </div>

        </div>
    </section>

@stop
