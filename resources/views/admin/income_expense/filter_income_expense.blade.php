@extends('admin.layouts.app')
<title>Manage income expense</title>
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
                        <li class="breadcrumb-item active">Manage income expense</li>
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

                    <form action="{{url('admin/filter_income_expense')}}" method="post">
                        @csrf
                         <div class="row mb-5">

                            <div class="col-xl-3 col-md-3">
                    
                                <label for="col-form-label">Type </label>

                                <select name="type" id="type" class="form-control type ">
                                    <option value="">Select</option>
                                    <option value="Income" @php if ($type == 'Income') { echo "selected"; } @endphp>Income</option>
                                    <option value="Expense" @php if ($type == 'Expense') { echo "selected"; } @endphp>Expense</option>
                                </select>
                       
                            </div>


                            <div class="col-xl-3 col-md-3">
                                <label class="col-form-label"><b> From  </b></label>
                                <input type="date" class="form-control" name="from_date" value="{{$from_date ?? ''}}">
                            </div>

                            <div class="col-xl-3 col-md-3">
                                <label class="col-form-label"><b> TO  </b></label>
                                <input type="date" class="form-control" name="to_date" value="{{$to_date ?? ''}}">
                            </div>
                            
                              <div class="col-xl-3 col-md-2">
                    
                                  <label for="col-form-label">Customer </label>

                                  <select name="company_id" class="form-control select2" id="">
                                      <option value="" selected>Select</option>
                                      @foreach($companies as $item)
                                      <option value="{{$item->id}}" @php if ($company_id == $item->id) { echo "selected"; } @endphp>{{$item->name}} - {{$item->phone}}</option>
                                      @endforeach    
                                  </select>
                         
                              </div>
                            
                              <div class="col-xl-3 col-md-3">
                    
                                  <label for="col-form-label">Category </label>

                                  <select name="income_expense_category_id" class="form-control select2" id="">
                                      <option value="" selected>Select</option>
                                      @foreach($categories as $item)
                                      <option value="{{$item->id}}" @php if ($income_expense_category_id == $item->id) { echo "selected"; } @endphp>{{$item->name}}</option>
                                      @endforeach    
                                  </select>
                         
                              </div>

                              <div class="col-xl-3 col-md-3">
                               
                                <label for="col-form-label">Status </label>

                                <select name="status" id="status" class="form-control status ">
                                    <option value="">Select</option>
                                    <option value="0" @php if ($status == 0) { echo "selected"; } @endphp>Due</option>
                                    <option value="1" @php if ($status == 1) { echo "selected"; } @endphp>Completed</option>
                                </select>
                       
                            </div>


                            <div class="col-xl-3 col-md-3">
                                <label class="col-form-label"><p></p></label><br>
                                <input type="submit" class="btn btn-warning text-white w-50" value="Filter">
                            </div> 

                        </div>
                    </form>


                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Manage income expense</h3>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                               
                         
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Category</th>
                                        <th>Customer</th>
                                        <th>Number</th>
                                        <th>Title</th>
                                        <th>Total  </th>
                                        <th> Pay </th>
                                        <th> Due </th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php 
                                        $i=1;
                                        $total = 0;
                                        $pay = 0;
                                        $due = 0;
                                    @endphp
                                    @foreach($datas as $item)
                                    @php 
                                        $i=1;
                                        $total = $total + $item->total;
                                        $pay = $pay + $item->amount;
                                        $due = $due + $item->due;
                                    @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                      
                                        <td>{{$item->type ?? ''}}</td>
                                        <td>{{$item->date ?? ''}}</td>
                                        <td>{{$item->income_expense_category->name ?? ''}}</td>
                                        <td>{{$item->company->name ?? ''}}</td>
                                        <td>{{$item->company->phone ?? ''}}</td>
                                        <td>{{$item->title ?? ''}}</td>
                                        <td>{{$item->total ?? 0}} </td>
                                        <td>{{$item->amount ?? 0}} </td>
                                        <td>{{$item->due ?? 0}} </td>
                                    
                                        <td>
                                            @php
                                            if($item->status == 0){
                                                echo  "<div class='badge badge-info badge-shadow'>Due</div>";
                                            }else{
                                                echo  "<div class='badge badge-success badge-shadow'>Completed</div>";
                                            }
                                            @endphp
                                        </td>
                                        <td class="d-flex">

                                            @if($item->status == 0)
                                            <a href="{{URL::to('admin/income_expense/'.$item->id.'/edit')}}" title="Edit" style="float: left;margin-right: 10px;">
                                                <button type="submit" class="btn btn-primary btn-sm mx-1"><i class="fa fa-edit"></i>
                                                </button>
                                            </a>
                                            @endif
                                            
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
                                            <td></td>
                                            <td></td>
                                            <td><b>{{ $total ?? 0 }} /-</b></td>
                                            <td><b>{{ $pay ?? 0 }} /-</b></td>
                                            <td><b>{{ $due ?? 0 }} /-</b></td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    </tfoot>
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