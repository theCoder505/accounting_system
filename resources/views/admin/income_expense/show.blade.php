@extends('admin.layouts.app')
<title>History</title>
<meta name="csrf-token" content="{{csrf_token()}}">
@section('content')

<style>
    
    .select2-selection.select2-selection--single{
        height: 39px;
    }

</style>

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
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">History</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- right column -->
                <div class="col-md-12">


                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">History</h3>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                
                                <div style="font-weight: bold">
                                    <span>Project: {{$data->project->name ?? ''}}</span> <br>
                                    <span>Client: {{$data->company->name ?? ''}} - {{$data->company->phone ?? ''}}</span> <br>
                                    <span>Budget:  {{$data->total ?? ''}}</span> <br>
                                    <span>Pay:  {{$data->amount ?? ''}}</span> <br>
                                    <span>Due:  {{$data->due ?? ''}}</span> <br>
                                </div>

                                <br>
                         
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Date</th>
                                        {{-- <th>Total  </th> --}}
                                        <th> Pay </th>
                                        <th> Due </th>
                                        <th>Note</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php 
                                        $i=1;
                                    @endphp
                                    @foreach($histories as $item)
                                    
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$item->date ?? ''}}</td>
                                        {{-- <td>{{$item->total ?? 0}} </td> --}}
                                        <td>{{$item->pay ?? 0}} </td>
                                        <td>{{$item->due ?? 0}} </td>
                                        <td>{{$item->note ?? ''}} </td>
                                    
                                    </tr>
                                    @php $i++; @endphp
                                    @endforeach
                                    </tbody>
                                 
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