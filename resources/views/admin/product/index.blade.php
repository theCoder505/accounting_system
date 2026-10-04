@extends('admin.layouts.app')
<title>Manage Book</title>
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
                                <h3 class="card-title">Manage Book</h3>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">

                              {{-- <form action="{{url('admin/filter_product')}}" method="post">
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
                                      
                               
                                      <div class="col-xl-2 col-md-2 mt-2">
                                          <label class="col-form-label"><p></p></label><br>
                                          <input type="submit" class="btn btn-warning text-white w-50" value="Filter">
                                      </div> 

                                  </div>
                              </form> --}}

                                <div class="mt-2 mb-3">
                                    <strong>
                                        <span style="color: red;">B. Price = Buying Price</span>,
                                        <span style="color: green;"> S. Price = Selling Price</span>,
                                        <span style="color: black;"> T. QTY = Total QTY</span>,
                                        <span style="color: blue;"> A. QTY = Available QTY</span>,
                                        <span style="color: red;"> T. Sell = Total Sell</span>
                                    </strong>
                                </div>
                                
                                
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Admin</th>
                                        <th>Name</th>
               
                                        <th>MRP (TK)</th>

                                        <th>A. QTY</th>
                                        <th>T. Sell</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; @endphp
                                    @foreach($products as $item)

                                    @if($item->qty > 5)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$item->admin->name ?? ''}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->selling_price }} /-</td>
                                            <td>{{$item->qty ?? 0}}</td>
                                            <td>{{$item->total_sell ?? 0}}</td>

                                            <td>
                                                @php
                                                if($item->status == 1){
                                                echo  "<div class='badge badge-success badge-shadow'>Active</div>";
                                                }else{
                                                echo  "<div class='badge badge-danger badge-shadow'>Inactive</div>";
                                                }
                                                @endphp
                                            </td>
                                            <td class="d-flex">

                                                <a href="{{URL::to('admin/product/'.$item->id.'/edit')}}" title="Edit" style="float: left;margin-right: 10px;">
                                                    <button type="submit" class="btn btn-primary btn-sm mx-1"><i class="fa fa-edit"></i>
                                                    </button>
                                                </a>

                                                
                                                <form action="{{URL::to('admin/product/'.$item->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                                                </form>

                                            </td>
                                        </tr>
                                    @else
                                        <tr style="background-color: #ffb700; color: white;">
                                            <td>{{$i}}</td>
                                            <!-- <td><img src="{{ asset($item->image) }}" alt="" style=" background: #fff; width: 100px;height: 50px;text-align: center;box-sizing: border-box;box-shadow: 6px 9px 11px -5px rgba(0,0,0,0.30);object-fit: cover"></td> -->
                                            <td>{{$item->admin->name ?? ''}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->selling_price }} /-</td>
                                            <td>{{$item->qty ?? 0}}</td>
                                            <td>{{$item->total_sell ?? 0}}</td>


                                            <td>@php
                                                if($item->status == 1){
                                                echo  "<div class='badge badge-success badge-shadow'>Active</div>";
                                                }else{
                                                echo  "<div class='badge badge-danger badge-shadow'>Inactive</div>";
                                                }
                                                @endphp
                                            </td>
                                            <td class="d-flex">

                                                <a href="{{URL::to('admin/product/'.$item->id.'/edit')}}" title="Edit" style="float: left;margin-right: 10px;">
                                                    <button type="submit" class="btn btn-primary btn-sm mx-1"><i class="fa fa-edit"></i>
                                                    </button>
                                                </a>

                                                
                                                <form action="{{URL::to('admin/product/'.$item->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                                                </form>

                                            </td>
                                        </tr>

                                    @endif
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