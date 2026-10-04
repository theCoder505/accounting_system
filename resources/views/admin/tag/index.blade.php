@extends('admin.layouts.app')
@section('title')
<title>Manage Tag  | {{ config('app.name') }}</title>
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
                    <h1>Tag Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tag Form</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if($admin->role_id == 1)
                <!-- left column -->
                <div class="col-md-5">
                    <!-- general form elements -->
                    <div class="card card-primary tag-form">
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
                            <h3 class="card-title">Add Tag</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('tag.store')}}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tag Name ( EN )</label>
                                            <input type="text" name="name" class="form-control" placeholder="Tag Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tag Name ( BN )</label>
                                            <input type="text" name="name_bn" class="form-control" placeholder="Tag Name ( BN )">
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Publication Status</label>
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
                @endif
                <!--/.col (left) -->
                <!-- right column -->
                @if($admin->role_id == 1)
                <div class="col-md-7">
                @else
                <div class="col-md-12">
                @endif
                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Manage Tag</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Name</th>
                                        <th>Name ( BN )</th>
                                        <th>Status</th>
                                        @if($admin->role_id == 1)
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; @endphp
                                    @foreach($tags as $item)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->name_bn ?? ''}}</td>
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
                                            <button data-id="{{$item->id}}" class="btn btn-primary  btn-sm tagEdit mx-1" >
                                                <span class="fa fa-edit"></span>
                                            </button>


                                            <form action="{{URL::to('admin/tag/'.$item->id)}}" method="post">
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