@extends('admin.layouts.app')
<title>Filter monthly collection</title>
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
                        <li class="breadcrumb-item active">Filter monthly collection</li>
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

                    <form action="{{url('admin/filter_monthly_collection')}}" method="post">
                        @csrf
                         <div class="row mb-5">

                            <div class="col-xl-2 col-md-2">
                                <label class="col-form-label"><b> From  </b></label>
                                <input type="date" class="form-control" name="from_date" value="{{$from_date ?? ''}}">
                            </div>

                            <div class="col-xl-2 col-md-2">
                                <label class="col-form-label"><b> TO  </b></label>
                                <input type="date" class="form-control" name="to_date" value="{{$to_date ?? ''}}">
                            </div>
                            
                              <div class="ol-xl-2 col-md-2">
                    
                                  <label for="col-form-label">Customer </label>

                                  <select name="company_id" class="form-control select2" id="">
                                      <option value="" selected>Select</option>
                                      @foreach($companies as $company)
                                      <option value="{{$company->id}}" @php if ($company_id == $company->id) { echo "selected"; } @endphp>{{$company->name}}</option>
                                      @endforeach    
                                  </select>
                         
                              </div>

                              <div class="col-md-1 ol-xl-2 ">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Year</label>
                                    <?php 
                                        // $year = date('Y');
                                        $year = 2030;
                                    ?>
                                    <select name="year" id="" class="form-control">
                                        <option value="">Select</option>
                                        @for($year == $year; $year > 2000; $year--)
                                            <option value="{{$year}}" @php if ($filter_year == $year) { echo "selected"; } @endphp>{{$year}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>


                            <div class="col-xl-2 col-md-2 mt-2">
                                <label class="col-form-label"><p></p></label><br>
                                <input type="submit" class="btn btn-warning text-white w-50" value="Filter">
                            </div> 

                        </div>
                    </form>


                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Filter monthly collection</h3>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                               
                         
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Date</th>
                                        <th>Year</th>
                                        <th>Customer</th>
                                        <th>Number</th>
                                        <th>Per month amount</th>
                                        <th>Total Pay Month</th>
                                        <th>Total Amount </th>
                                        <th>Total Pay </th>
                                        <th>Total Due </th>
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
                                    <?php
                                        $full_year_amount = $item->per_month_amount * 12;
                                        $total = $total +  $full_year_amount;
                                        $pay = $pay + $item->total_pay;
                                        $due = $due + $item->total_due;

                                        $months = App\Models\MonthlyCollectionMonths::where('monthly_collection_id', $item->id)->count();
                                    ?>
                                    <tr>
                                        <td>{{$i}}</td>
                                      
                                        <td>{{$item->date ?? ''}}</td>
                                        <td>{{$item->year ?? ''}}</td>
                                        <td>{{$item->company->name ?? ''}}</td>
                                        <td>{{$item->company->phone ?? ''}}</td>
                                        <td>{{$item->per_month_amount ?? ''}}</td>
                                        <td>{{$months ?? ''}}</td>
                                        <td>{{$item->per_month_amount * 12}} </td>
                                        <td>{{$item->total_pay ?? 0}} </td>
                                        <td>{{$item->total_due ?? 0}} </td>
                                    
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

                                            <a href="{{URL::to('admin/monthly_collection/'.$item->id.'/edit')}}" title="Edit" style="float: left;margin-right: 10px;">
                                                <button type="submit" class="btn btn-primary btn-sm mx-1"><i class="fa fa-edit"></i>
                                                </button>
                                            </a>
                                            
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
                                            <td><b>{{ $total ?? '0' }}</b></td>
                                            <td><b>{{ $pay ?? '0' }}</b></td>
                                            <td><b>{{ $due ?? '0' }}</b></td>
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