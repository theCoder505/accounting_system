@extends('admin.layouts.app')
@section('title')
<title>{{ config('app.name') }} | Manage income_expense_category</title>
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
                    <h1>income_expense_category Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">income_expense_category Form</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-5">
                    <!-- general form elements -->
                    <div class="card card-primary income_expense_category-form">
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
                            <h3 class="card-title">Add income_expense_category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('income_expense_category.store')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Type</label>
                                            <select class="custom-select" name="type">
                                                <option value="Income">Income</option>
                                                <option value="Expense">Expense</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> Name </label>
                                            <input type="text" name="name" class="form-control" placeholder=" Name">
                                        </div>
                                    </div>

                               
                           
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Status</label>
                                            <select class="custom-select" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
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
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-7">
             
                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Manage income_expense_category</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        @if($admin->role_id == 1)
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; @endphp
                                    @foreach($categories as $item)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$item->type}}</td>
                                        <td>{{$item->name}}</td>
                                   
                                        <td>@php
                                            if($item->status == 1){
                                            echo  "<div class='badge badge-success badge-shadow'>Active</div>";
                                            }else{
                                            echo  "<div class='badge badge-danger badge-shadow'>Inactive</div>";
                                            }
                                            @endphp
                                        </td>
                                        <td class="d-flex">

                                            @if($admin->role_id == 1)
                                            <button data-id="{{$item->id}}" class="btn btn-primary  btn-sm editincome_expense_category mx-1" >
                                                <span class="fa fa-edit"></span>
                                            </button>

                                            
                                            <form action="{{URL::to('admin/income_expense_category/'.$item->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                                            </form>
                                            @endif

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