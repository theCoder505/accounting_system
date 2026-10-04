@extends('admin.layouts.app')
@section('title')
<title>Create Project  | {{ config('app.name') }}</title>
<meta name="csrf-token" content="{{csrf_token()}}">
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Project Form</h1>
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
                    <div class="card card-primary project-form">
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
                            <h3 class="card-title">Add Project</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('project.store')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Client </label>
                                            <select name="company_id" class="form-control" id="" required>
                                                <option value="">Select</option>

                                                @foreach($companies as $item)
                                                <option value="{{$item->id}}">{{$item->name}} - {{$item->phone}} </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Name </label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Project Budget </label>
                                            <input type="number" name="project_budget" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Technology </label>
                                            <select name="technology_id" class="form-control" id="" required>
                                                <option value="">Select</option>

                                                @foreach($technologies as $item)
                                                <option value="{{$item->id}}">{{$item->name}} </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Category </label>
                                            <select name="category_id" class="form-control" id="" required>
                                                <option value="">Select</option>
                                                @foreach($categories as $item)
                                                <option value="{{$item->id}}">{{$item->name}} </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Start date </label>
                                            <input type="date" name="start_date" class="form-control">
                                        </div>
                                    </div>
                                    


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Delivery date </label>
                                            <input type="date" name="delivery_date" class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Domain Name </label>
                                            <input type="text" name="domain_name" class="form-control">
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Domain Expair Date </label>
                                            <input type="date" name="domain_expire_date" class="form-control">
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="custom-select" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Admin Details Entry </label>
                                            <textarea name="admin_details_entry" class="form-control" id="" rows="3"></textarea>
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
@endsection