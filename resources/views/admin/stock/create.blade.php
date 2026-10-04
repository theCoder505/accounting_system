@extends('admin.layouts.app')
<title> Add Stock</title>
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
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Add Stock</li>
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
                            <h3 class="card-title">Add Stock</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('stock.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                
                            	<div class="row">
                            	
	                            	<div class="col-md-6">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Book<span style="color: red">*</span></label>
		                                    
		                                    <select name="product_id" id="product_id" class="form-control product_id select2" required="" onchange="getProductDetails(this.value)">
		                                    	<option value="0" selected disabled>Select</option>
		                                        @foreach($products as $product)
		                                        <option value="{{$product->id}}">{{$product->name}} </option>
		                                        @endforeach
		                                    </select>
		                                </div>
	                            	</div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Available Qty</label>
                                            <input type="number" class="form-control availableQty" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Buying Price</label>
                                            <input type="number" step="0.01" name="buying_price" class="form-control" value="0">
                                        </div>
                                    </div>




                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Qty</label>
                                            <input type="number" name="qty" class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Date</label>
                                            <input type="date" name="date" class="form-control" required>
                                        </div>
                                    </div>

                            	</div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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