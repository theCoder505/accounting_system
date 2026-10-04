@extends('admin.layouts.app')
@section('title')
    <title>Manage Project | {{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content mt-5">
            <div class="container-fluid">
                <div class="row">


                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-info">

                            <div class="card-header">
                                <h3 class="card-title">Manage Project</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <form action="{{ url('admin/filter_project') }}" method="get">

                                    <div class="row mb-5">



                                        <div class="col-xl-3 col-md-3">

                                            <label class="col-form-label"><b> Client </b></label>
                                            <br>
                                            <select name="company_id" class="select2 form-control " id="">
                                                <option value="" selected disabled>Select</option>
                                                @foreach ($companies as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }} -
                                                        {{ $item->phone }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-xl-3 col-md-3">

                                            <label class="col-form-label"><b> Category </b></label>
                                            <br>
                                            <select name="category_id" class="select3 form-control "
                                                id="">
                                                <option value="" selected disabled>Select</option>
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>



                                        <div class="col-xl-3 col-md-3">

                                            <label class="col-form-label"><b> Technology </b></label>
                                            <br>
                                            <select name="technology_id" class="select3 form-control " id="">
                                                <option value="" selected disabled>Select</option>
                                                @foreach ($technologies as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>



                                        {{-- <div class="col-xl-3 col-md-3">
  
                                            <label class="col-form-label"><b> Project Name </b></label>
                                            <br>
                                            <input type="text" name="name" class="form-control">
                                        </div>       
     --}}

                                        <div class="col-xl-3 col-md-3">

                                            <label class="col-form-label"><b>Start Date </b></label>
                                            <br>
                                            <input type="date" name="start_date" class="form-control">
                                        </div>


                                        <div class="col-xl-3 col-md-3">

                                            <label class="col-form-label"><b>Delivery Date </b></label>
                                            <br>
                                            <input type="date" name="delivery_date" class="form-control">
                                        </div>


                                        <div class="col-xl-3 col-md-3">
                                            <label class="col-form-label">
                                                <p></p>
                                            </label><br>
                                            <input type="submit" class="btn btn-warning text-white w-50" value="Filter">
                                        </div>

                                    </div>
                                </form>

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Client</th>
                                            <th>Category</th>
                                            <th>Technology</th>
                                            <th>Name</th>
                                            <th>Budget</th>
                                            <th>Paid</th>
                                            <th>Due</th>
                                            <th>Start Date</th>
                                            <th>Delivery Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                            $total_budget = 0;
                                            $total_pay = 0;
                                            $total_due = 0;
                                        @endphp
                                        @foreach ($projects as $item)
                                            @php
                                                $total_budget = $total_budget + $item->project_budget;
                                                $total_pay = $total_pay + $item->total_pay;
                                                $total_due = $total_due + $item->total_due;
                                            @endphp

                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $item->company->name ?? '' }}</td>
                                                <td>{{ $item->category->name ?? '' }}</td>
                                                <td>{{ $item->technology->name ?? '' }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->project_budget }}</td>
                                                <td>{{ $item->total_pay }}</td>
                                                <td>{{ $item->total_due }}</td>
                                                <td>{{ Carbon\Carbon::parse($item->start_date)->format('d M Y') }}</td>
                                                <td>{{ Carbon\Carbon::parse($item->delivery_date)->format('d M Y') }}</td>

                                                <td>@php
                                                    if ($item->status == 1) {
                                                        echo "<div class='badge badge-success badge-shadow'>Active</div>";
                                                    } else {
                                                        echo "<div class='badge badge-danger badge-shadow'>Inactive</div>";
                                                    }
                                                @endphp
                                                </td>
                                                <td class="d-flex">


                                                    <a href="{{ URL::to('admin/project/' . $item->id . '/edit') }}"
                                                        title="Edit" style="float: left;margin-right: 10px;">
                                                        <button type="submit" class="btn btn-primary btn-sm mx-1"><i
                                                                class="fa fa-edit"></i>
                                                        </button>
                                                    </a>

                                                    <form action="{{ URL::to('admin/project/' . $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm" type="submit"><i
                                                                class="fa fa-trash"></i></button>
                                                    </form>

                                                </td>
                                            </tr>
                                            @php $i++; @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b>{{$total_budget ?? '0'}}</b></td>
                                            <td><b>{{$total_pay ?? '0'}}</b></td>
                                            <td><b>{{$total_due ?? '0'}}</b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->

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
