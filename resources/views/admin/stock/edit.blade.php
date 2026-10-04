@extends('admin.layouts.app')
<title> Edit Stock</title>
<meta name="csrf-token" content="{{csrf_token()}}">
@section('content')



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
                        <li class="breadcrumb-item"><a href="{{url('admin/stock')}}">Stock</a></li>
                        <li class="breadcrumb-item active">Edit Stock</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="card-header">
                            <h3 class="card-title">Edit Stock</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('stock.update',$data->id)}}" method="post"  enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="card-body">
                                
                            	<div class="row">
                            	
	                            	<div class="col-md-6">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Book<span style="color: red">*</span></label>
		                                    
		                                    <select name="product_id" id="product_id" class="form-control product_id" required="" onchange="getProductDetails(this.value)">
		                                    	<option value="0" selected disabled>Select</option>
		                                        @foreach($products as $product)
		                                        <option value="{{$product->id}}" @php echo $data->product_id==$product->id?"selected":""; @endphp>{{$product->name}}</option>
		                                        @endforeach
		                                    </select>
		                                </div>
	                            	</div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Was Available Qty</label>
                                            <input type="number" class="form-control availableQty" value="{{ $data->available_qty ?? $data->qty }}" name="available_qty" readonly>
                                        </div>
                                    </div>

                                    

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Qty</label>
                                            <input type="number" name="qty" value="{{ $data->qty }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Total Qty</label>
                                            <input type="number" class="form-control " value="{{ $data->total_qty }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Date</label>
                                            <input type="date" name="date" value="{{ $data->date }}"  class="form-control" required>
                                        </div>
                                    </div>
                                    

                            	</div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
                <div class="col-md-3"></div>

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


    <script>
        
      //getProductDetails



    </script>

@endsection