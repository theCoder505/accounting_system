@extends('admin.layouts.app')
<title>Manage Sell</title>
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
                        <li class="breadcrumb-item active">Manage Sell</li>
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
                                <h3 class="card-title">Manage Sell</h3>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                               
                              <form action="{{url('admin/filter_sell')}}" method="post">
                                  @csrf
                                   <div class="row mb-5">

                                      <div class="col-xl-2 col-md-2">
                                          <label class="col-form-label"><b> From  </b></label>
                                          <input type="date" class="form-control" name="from_date">
                                      </div>

                                      <div class="col-xl-2 col-md-2">
                                          <label class="col-form-label"><b> TO  </b></label>
                                          <input type="date" class="form-control" name="to_date">
                                      </div>
                                      
                                        <div class="ol-xl-2 col-md-2">
                              
                                            <label for="col-form-label">Customer </label>

                                            <select name="company_id" class="form-control select2" id="">
                                                <option value="" selected>Select</option>
                                                @foreach($companies as $company)
                                                <option value="{{$company->id}}">{{$company->name}}</option>
                                                @endforeach    
                                            </select>
                                   
                                        </div>

                                        <div class="col-xl-2 col-md-2">
                                          <label class="col-form-label"><b> Status </b></label>
                                          <select class="custom-select select2" name="status">
                                                <option value="">Select</option>
                                                {{-- <option value="Pending">Pending</option>
                                                <option value="Processing">Processing</option> --}}
                                                <option value="Completed">Completed</option>
                                            </select>
                                        </div>

                                      <div class="col-xl-2 col-md-2 mt-2">
                                          <label class="col-form-label"><p></p></label><br>
                                          <input type="submit" class="btn btn-warning text-white w-50" value="Filter">
                                      </div> 

                                  </div>
                              </form>

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Admin</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Number</th>
                                        <th>Total (TK)</th>
                                        <th>Discount (%)</th>
                                        <th>Discount (TK)</th>
                                        <th>Pay (TK)</th>
                                        <th>Due (TK)</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; @endphp
                                    @foreach($sells as $item)
                                    <tr>
                                        
                                        <td>{{$i}}</td>
                                        <td>{{$item->admin->name ?? ''}}</td>
                                        <td>{{$item->date ?? ''}}</td>
                                        <td>{{$item->company->name ?? ''}}</td>
                                        <td>{{$item->company->phone ?? ''}}</td>
                                        <td>{{$item->total ?? 0}} /-</td>
                                        <td>{{$item->discount_percentage ?? 0}}</td>
                                        <td>{{$item->total_discount_amount ?? 0}} /-</td>
                                        <td>{{$item->pay ?? 0}} /-</td>
                                        <td>{{$item->due ?? 0}} /-</td>
                                    
                                        <td>
                                            @php
                                            if($item->status == 'Pending'){
                                                echo  "<div class='badge badge-info badge-shadow'>Pending</div>";
                                            }elseif($item->status == 'Processing'){
                                                echo  "<div class='badge badge-warning text-white badge-shadow'>Processing</div>";
                                            }else{
                                                echo  "<div class='badge badge-success badge-shadow'>Completed</div>";
                                            }
                                            @endphp
                                        </td>

                                        <td class="d-flex">

                                            {{-- <a href="{{URL::to('admin/sell/'.$item->id.'/edit')}}" title="Edit" style="float: left;margin-right: 10px;">
                                                <button type="submit" class="btn btn-primary btn-sm mx-1"><i class="fa fa-edit"></i>
                                                </button>
                                            </a> --}}

                                            <a href="{{URL::to('admin/invoice', $item->id)}}" title="Edit" style="float: left;margin-right: 10px;" target="_blank">
                                                <button type="submit" class="btn btn-primary btn-sm mx-1">
                                                    <i class="fa fa-solid fa-file-invoice"></i>
                                                </button>
                                            </a>

                                            
                                            <form action="{{URL::to('admin/sell/'.$item->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                                            </form>

                                        </td>
                                    </tr>
                                    @php $i++; @endphp
                                    @endforeach
                                </table>
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