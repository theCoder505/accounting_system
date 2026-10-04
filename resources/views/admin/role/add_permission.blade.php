@extends('admin.layouts.app')
@section('title')
<title>{{ config('app.name') }} | Manage Role</title>
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
                    <h1>Role Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Role Form</li>
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
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card-primary role-form">
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
                            <h3 class="card-title">Assign Permission</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('submit-permission')}}" method="post">
                            @csrf
                            <ul style="list-style: none;padding: 0;">
                                <li style="border: 1px solid gainsboro;padding-left: 10px;padding-top: 6px;margin-bottom: 8px;">
                                    <div class="mr-2">
                                        <label for="exampleInputEmail1">Role </label> 
                                        <select name="role_id" class="form-control mb-3" required="">
                                            <option value="">Select</option>
                                            @foreach($roles as $item)
                                                @if($id ?? '')
                                                    <option value="{{$item->id}}"  @php if ($id == $item->id) { echo "selected"; } @endphp>{{$item->title}}</option>
                                                @else
                                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </li> 
                                <li style="border: 1px solid gainsboro;padding-left: 10px;padding-top: 6px;margin-bottom: 8px;">
                                    <div class=" ml-3">
                                        <input type="checkbox" name="dashboard" id="Dashboard" checked="">
                                        <label for="Dashboard">Dashboard </label> 
                                    </div>
                                </li>
                                <li style="border: 1px solid gainsboro;padding-left: 10px;padding-top: 6px;margin-bottom: 8px;">
                                    <div class="">
                                        <label for="exampleInputEmail1">Category </label> 
                                    </div>
                                    <div class=" ml-3">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="category_create" id="category_create">
                                            <label  for="category_create">Create </label> 
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="category_edit" id="category_edit">
                                            <label  for="category_edit">Edit </label> 
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="category_delete" id="category_delete">
                                            <label for="category_delete">Delete </label> 
                                        </div>
                                    </div>
                                </li>
                                <li style="border: 1px solid gainsboro;padding-left: 10px;padding-top: 6px;margin-bottom: 8px;">
                                    <div class="">
                                        <label for="exampleInputEmail1">Tag </label> 
                                    </div>
                                    <div class=" ml-3">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="tag_create" id="tag_create">
                                            <label for="tag_create">Create </label> 
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="tag_edit" id="tag_edit">
                                            <label for="tag_edit">Edit </label> 
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="tag_delete" id="tag_delete">
                                            <label for="tag_delete">Delete </label> 
                                        </div>
                                    </div>
                                </li>
                                <li style="border: 1px solid gainsboro;padding-left: 10px;padding-top: 6px;margin-bottom: 8px;">
                                    <div class="">
                                        <label for="exampleInputEmail1">Subject </label> 
                                    </div>
                                    <div class=" ml-3">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="subject_create" id="subject_create">
                                            <label for="subject_create">Create </label> 
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="subject_edit" id="subject_edit">
                                            <label for="subject_edit">Edit </label> 
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="subject_delete" id="subject_delete">
                                            <label for="subject_delete">Delete </label> 
                                        </div>
                                    </div>
                                </li>
                                <li style="border: 1px solid gainsboro;padding-left: 10px;padding-top: 6px;margin-bottom: 8px;">
                                    <div class="">
                                        <label for="exampleInputEmail1">Banner </label> 
                                    </div>
                                    <div class=" ml-3">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="banner_create" id="banner_create">
                                            <label for="banner_create">Create </label> 
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="banner_edit" id="banner_edit">
                                            <label for="banner_edit">Edit </label> 
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="banner_delete" id="banner_delete">
                                            <label for="banner_delete">Delete </label> 
                                        </div>
                                    </div>
                                </li>
                                <li style="border: 1px solid gainsboro;padding-left: 10px;padding-top: 6px;margin-bottom: 8px;">
                                    <div class="">
                                        <label for="exampleInputEmail1">Post </label> 
                                    </div>
                                    <div class=" ml-3">
                                        <div class="col-md-6">
                                            <input type="checkbox" name="post_create" id="post_create">
                                            <label for="post_create">Create </label> 
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="post_edit" id="post_edit">
                                            <label for="post_edit">Edit </label> 
                                        </div>
                                        <div class="col-md-6">
                                            <input type="checkbox" name="post_delete" id="post_delete">
                                            <label for="post_delete">Delete </label> 
                                        </div>
                                    </div>
                                </li>
                                <li style="border: 1px solid gainsboro;padding-left: 10px;padding-top: 6px;margin-bottom: 8px;">
                                    <div class="">
                                        <label for="exampleInputEmail1">Settings </label> 
                                    </div>
                                    <div class="ml-3">
                                        <input type="checkbox" name="website_settings" id="website_settings">
                                        <label for="website_settings">Website Settings </label> 
                                    </div>
                                </li>
                            </ul>
                            <button type="submit" class="form-control mb-3 btn-primary">Submit</button>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-8">
                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Manage Role</h3>
                                <a href="{{route('add-permission')}}"><button  type="button" class="btn btn-primary btn-sm mx-3" style="float: right;"> <i class="fas fa-user-shield"></i> Add Permission</button></a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; @endphp
                                    @foreach($roles as $item)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>@php
                                            if($item->status == 1){
                                            echo  "<div class='badge badge-success badge-shadow'>Active</div>";
                                            }else{
                                            echo  "<div class='badge badge-danger badge-shadow'>Inactive</div>";
                                            }
                                            @endphp
                                        </td>
                                        <td class="d-flex">
                                            <button data-id="{{$item->id}}" class="btn btn-primary editRole  btn-sm  mx-1" >
                                                <span class="fa fa-edit"></span>
                                            </button>

                                            <a href="{{route('edit-permission', [$item->id])}}"><button  type="button" class="btn btn-primary btn-sm mx-3" style="float: right;"> <i class="fas fa-user-shield"></i> Edit Permission</button></a>

                                            <form action="{{URL::to('admin/role/'.$item->id)}}" method="post">
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