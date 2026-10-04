@extends('frontend.layouts.app')
<title> Enquiry - {{ config('app.name', 'Laravel') }}</title>
@section('content')

    <section class="page_title ls s-py-50 corner-title ls invise overflow-visible">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Enquiry </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ URL::to('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Pages</a>
                        </li>
                        <li class="breadcrumb-item active">
                             Enquiry
                        </li>
                    </ol>
                    <div class="divider-15 d-none d-xl-block"></div>
                </div>
            </div>
        </div>
    </section>


    <section class="ls s-pt-30 s-pb-130 s-pt-md-75">
        <div class="container">
            <div class="row">
               
                <div class="divider-40 d-none d-xl-block"></div>

                <div class="col-lg-8 offset-lg-2 animate" data-animation="scaleAppear">

                    <div class="divider-40 d-none d-xl-block"></div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="c-mb-20 text-center" method="post"
                        action="{{route('submit_enquiry')}}">
                        @csrf

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group has-placeholder">
                                    <label for="name">Full Name
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" aria-required="true" size="30" value name="name"
                                        id="name" class="form-control" placeholder="Full Name" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group has-placeholder">
                                    <label for="email">Email address
                                        <span class="required">*</span>
                                    </label>
                                    <input type="email" aria-required="true" size="30" value name="email"
                                        id="email" class="form-control" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group has-placeholder">
                                    <label for="phone_number">Phone Number
                                        <span class="required">*</span>
                                    </label>
                                    <input type="phone_number" aria-required="true" size="30" value name="phone_number"
                                        id="phone_number" class="form-control" placeholder="Phone Number*" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">

                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label for="category" style="text-align: start;">Category
                                        <span class="required">*</span>
                                    </label>
        
                                    <select name="category_id"
                                        class="woocommerce-Input woocommerce-Input--text input-text" id="" required>
                                        <option value="">Select</option>
        
                                        @foreach($categories as $item)

                                            <option value="{{ $item->id }}">{{ $item->name }}</option>

                                        @endforeach
        
                                    </select>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group has-placeholder">
                                    <label for="project_details">Project Details</label>
                                    <textarea aria-required="true" rows="6" cols="45" name="project_details" id="project_details" class="form-control"
                                        placeholder="Write the description of your project here" required></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="row c-mt-md-15 c-md-0">
                            <div class="col-sm-12">
                                <div class="form-group text-center contact-form1">
                                    <button type="submit" id="" name=""
                                        class="btn btn-maincolor">Send Enquiry</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!--.col-* -->

                <div class="divider-75 d-none d-xl-block"></div>

            </div>
        </div>
    </section>



@stop
