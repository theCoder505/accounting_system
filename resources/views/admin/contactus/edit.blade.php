@extends('admin.layouts.app')
@section('title')
    <title>Edit contactus | {{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>contactus Form</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
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
                          

                            <form action="{{ route('contact_us.update', $data->id) }}" method="post"
                                enctype="multipart/form-data">
                                @method('patch')
                                @csrf

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $data->name }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> phone_number </label>
                                                <input type="text" name="phone_number" class="form-control"
                                                    value="{{ $data->phone_number }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> email </label>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ $data->email }}">
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="1"
                                                        @php if ($data['status'] == 1) { echo "selected"; } @endphp>Completed
                                                    </option>
                                                    <option value="0"
                                                        @php if ($data['status'] == 0) { echo "selected"; } @endphp>Pending
                                                    </option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"> message </label>
                                                <textarea name="message" class="form-control" cols="30" rows="10">{!! $data->message !!}</textarea>
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
                    <!--/.col (left) -->
                    <!-- right column -->

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
