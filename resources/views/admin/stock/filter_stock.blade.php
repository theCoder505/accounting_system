@extends('admin.layouts.app')
<title>Filter Stock</title>
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
                        <li class="breadcrumb-item active">Filter Stock</li>
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
                                <h3 class="card-title">Filter Stock</h3>
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
                                          <input type="date" class="form-control" value="{{ $from_date ?? '' }}" name="from_date">
                                      </div>

                                      <div class="col-xl-2 col-md-2">
                                          <label class="col-form-label"><b> TO <i class="text-danger">*</i> </b></label>
                                          <input type="date" class="form-control" value="{{ $to_date ?? '' }}" name="to_date">
                                      </div>


                                      <div class="col-xl-2 col-md-2">

                                        <label class="col-form-label"><b> Product </b></label>
                                        <br>
                                        <select name="product_id" class="select2 form-control " id="">
                                            <option value="" selected disabled>Select</option>
                                            @foreach($products as $product)
                                              <option value="{{ $product->id }}" @php if ($product_id == $product->id) { echo "selected"; } @endphp>{{ $product->name }}</option>
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
                                        <th>Product</th>
                                        <th>Buy Price</th>
                                        <th>A. QTY</th>
                                        <th>QTY ( + )</th>
                                        <th>T. QTY</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php 
                                        $i=1; 
                                        $available_qty = 0;
                                        $qty = 0;
                                        $total_qty = 0;

                                    @endphp
                                    @foreach($datas as $item)

                                    <?php
                                        if($item->available_qty == 0){
                                            $available_qty = $available_qty + $item->qty;
                                        }else{
                                            $available_qty = $available_qty + $item->available_qty;
                                        }
                                        $qty = $qty + $item->qty;
                                        $total_qty = $total_qty + $item->total_qty;
                                    ?>

                                    <tr>
                                        <td>{{$i}}</td>
                               

                                        <td>{{$item->product->name ?? ''}}</td>
                                        <td>{{$item->buying_price ?? 0}}</td>

                                        <td>{{$item->available_qty ??  $item->qty}}</td>
                                        <td>{{$item->qty ?? 0}}</td>
                                        <td>{{$item->total_qty ?? 0}}</td>
                                        <td>{{  $item->created_at->format('d/m/y g:i A');}}</td>

                                        <td class="d-flex">

                                            <a href="{{URL::to('admin/stock/'.$item->id.'/edit')}}" title="Edit" style="float: left;margin-right: 10px;">
                                                <button type="submit" class="btn btn-primary btn-sm mx-1"><i class="fa fa-edit"></i>
                                                </button>
                                            </a>

                                            <!-- 
                                            <form action="{{URL::to('admin/stock/'.$item->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                                            </form> -->

                                        </td>
                                    </tr>
                                    @php $i++; @endphp
                                    @endforeach
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <strong>
                                                    Total
                                                </strong>
                                            </td>
                                            <td>
                                                <strong>
                                                    @php echo $available_qty ?? 0 ;  @endphp 
                                                </strong>
                                            </td>
                                            <td>
                                                <strong>
                                                    @php echo $qty ?? 0 ;  @endphp 
                                                </strong>
                                            </td>
                                            <td>
                                                <strong>
                                                    @php echo $total_qty ?? 0 ;  @endphp 
                                                </strong>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        
                                    </tfoot>
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