@extends('admin.layouts.app')
@section('title')
<title>Pending contact_us  | {{ config('app.name') }}</title>
<meta name="csrf-token" content="{{csrf_token()}}">
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

             
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pending contact_us</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; @endphp
                                    @foreach($datas as $item)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->phone_number}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
       
                                        <td>@php
                                            if($item->status == 1){
                                            echo  "<div class='badge badge-success badge-shadow'>Complete</div>";
                                            }else{
                                            echo  "<div class='badge badge-danger badge-shadow'>Pending</div>";
                                            }
                                            @endphp
                                        </td>
                                        <td class="d-flex">


                                            
                                            <a href="{{URL::to('admin/contact_us/'.$item->id.'/edit')}}" title="Edit" style="float: left;margin-right: 10px;">
                                                <button type="submit" class="btn btn-primary btn-sm mx-1"><i class="fa fa-edit"></i>
                                                </button>
                                            </a>



                                            <form action="{{URL::to('admin/contact_us/'.$item->id)}}" method="post">
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