@extends('admin.layouts.app')
<title>Manage Stock</title>
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
                        <li class="breadcrumb-item active">Manage Stock</li>
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
                                <h3 class="card-title">Manage Stock</h3>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                               <div class="mt-2 mb-3">
                                    <strong>
                                        <span style="color: red;"> T. QTY = Total QTY</span>,
                                        <span style="color: blue;"> A. QTY = Available QTY</span>,
                                    </strong>
                                </div>

                              <form action="{{url('admin/filter_stock')}}" method="post">
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

                               

                                      <div class="col-xl-2 col-md-2">

                                          <label class="col-form-label"><b> Product </b></label>
                                          <br>
                                          <select name="product_id" class="select2 form-control " id="">
                                              <option value="" selected disabled>Select</option>
                                              @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                              @endforeach
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
                                        <th>Product</th>
                                        <th>Buy Price</th>
                                        <th>A. QTY</th>
                                        <th>QTY ( + )</th>
                                        <th>T. QTY</th>
                                        <th>Date</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; @endphp
                                    @foreach($stocks as $item)
                                    <tr>
                                        <td>{{$i}}</td>
                               
                                        <td>{{$item->admin->name ?? ''}}</td>
                                        <td>{{$item->product->name ?? ''}}</td>
                                        <td>{{$item->buying_price ?? 0}}</td>

                                        <td>{{$item->available_qty ??  $item->qty}}</td>
                                        <td>{{$item->qty ?? 0}}</td>
                                        <td>{{$item->total_qty ?? 0}}</td>
                                        <td>{{  $item->created_at->format('d/m/y g:i A');}}</td>

                                        {{-- <td class="d-flex">

                                          <a href="{{URL::to('admin/stock/'.$item->id.'/edit')}}" title="Edit" style="float: left;margin-right: 10px;">
                                                <button type="submit" class="btn btn-primary btn-sm mx-1"><i class="fa fa-edit"></i>
                                                </button>
                                            </a> 

                                            
                                            <form action="{{URL::to('admin/stock/'.$item->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                                            </form> 

                                        </td> --}}
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