@extends('admin.layouts.app')
<title>Report</title>
<meta name="csrf-token" content="{{csrf_token()}}">
@section('content')

<style>
    
    .select2-selection.select2-selection--single{
        height: 39px;
    }

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Report</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- right column -->
                <div class="col-md-12">

                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Report</h3>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">

                              <form action="#" method="post">
                                  @csrf
                                   <div class="row mb-5">

                                      <div class="col-xl-2 col-md-2">
                                          <label class="col-form-label"><b> From <i class="text-danger">*</i> </b></label>
                                          <input type="date" class="form-control" name="from_date">
                                      </div>

                                      <div class="col-xl-2 col-md-2">
                                          <label class="col-form-label"><b> TO <i class="text-danger">*</i> </b></label>
                                          <input type="date" class="form-control" name="to_date">
                                      </div>
                                      
                                      
                                      <div class="ol-xl-2 col-md-2">
                              
                                        <label for="col-form-label">Company </label>
                                        <select name="company_id" class="form-control select2" id="">
                                            <option value="" selected>Select</option>
                                            @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                            @endforeach    
                                        </select>
                               
                                    </div>


                                      {{-- <div class="col-xl-2 col-md-2">
                                          <label class="col-form-label"><b> Category <i class="text-danger">*</i> </b></label>
                                            <select name="category_id" id="category_id" class="form-control select2" required="">
                                                <option value="0" selected disabled>Select</option>
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                      </div>
                                      
                                      <div class="col-xl-2 col-md-2">
                                          <label class="col-form-label"><b>Sub Category <i class="text-danger">*</i> </b></label>
                                            <select name="subcategory_id" id="subcategory_id" class="form-control select2" required="">
                                                <option value="0" selected disabled>Select</option>
                                                @foreach($subcategories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                      </div>
                                      
                                      <div class="col-xl-2 col-md-2">
                                          <label class="col-form-label"><b>Brand <i class="text-danger">*</i> </b></label>
                                            <select name="brand_id" id="brand_id" class="form-control select2" required="">
                                                <option value="0" selected disabled>Select</option>
                                                @foreach($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                @endforeach
                                            </select>
                                      </div> --}}

                                      <div class="col-xl-2 col-md-2 mt-2">
                                          <label class="col-form-label"><p></p></label><br>
                                          <input type="submit" class="btn btn-warning text-white w-50" value="Filter">
                                      </div> 

                                  </div>
                              </form>

                              
                              
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card-header -->

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
@section('script')
    @include('admin.layouts.js_script_backend')
@endsection