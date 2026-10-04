@extends('admin.layouts.app')
<title> Edit Book</title>
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
                            <h3 class="card-title">Edit Book</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('product.update',$data->id)}}" method="post"  enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="card-body">
                                
                            	<div class="row">
                            		<div class="col-md-12">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Name</label>
		                                    <input type="text" name="name" class="form-control"placeholder="Name" value="{{ $data->name }}" required>
		                                </div>
                            		</div>
                        


	                            	<div class="col-md-12">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Selling Price</label>
		                                    <input type="number" step="0.5" name="selling_price" value="{{ $data->selling_price }}" class="form-control" required>
		                                </div>
                            		</div>
                          

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label> Status</label>
                                            <select class="custom-select" name="status">
                                                <option value="1" @php if ($data['status'] == 1) { echo "selected"; } @endphp>Active</option>
                                                <option value="0" @php if ($data['status'] == 0) { echo "selected"; } @endphp>Inactive</option>
                                            </select>
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
@endsection