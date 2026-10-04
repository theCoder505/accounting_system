@extends('admin.layouts.app')
<title>Transactions</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
    <style>
        .select2-selection.select2-selection--single {
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
                            <li class="breadcrumb-item active">Transactions</li>
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

                        <form action="{{ url('admin/filter_transaction') }}" method="post">
                            @csrf
                            <div class="row mb-5">

                                <div class="col-xl-3 col-md-3">

                                    <label for="col-form-label">Type </label>

                                    <select name="type" id="type" class="form-control type ">
                                        <option value="">Select</option>
                                        <option value="Income">Income</option>
                                        <option value="Expense">Expense</option>
                                    </select>

                                </div>


                                <div class="col-md-3 col-xl-3 ">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Year</label>
                                        <?php
                                        $year = date('Y');
                                        // $year = 2030;
                                        ?>
                                        <select name="year" id="" class="form-control">
                                            <option value="">Select</option>
                                            @for ($year == $year; $year > 2000; $year--)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-xl-3 ">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Month</label>
                                       
                                        <select name="month" id="" class="form-control" >
                                            <option value="">Select</option>
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-3">

                                    <label for="col-form-label">Company </label>

                                    <select name="company_id" class="form-control company_id select2" id="company_id"
                                        onchange="getProjects(this.value)">
                                        <option value="" selected>Select</option>

                                        @foreach ($companies as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->phone }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="col-xl-3 col-md-3">

                                    <label for="col-form-label">Project </label>

                                    <select name="project_id" class="form-control project_id" id="project_id">
                                        <option value="" selected>Select</option>


                                    </select>

                                </div>


                                <div class="col-xl-3 col-md-3">
                                    <label class="col-form-label">
                                        <p></p>
                                    </label><br>
                                    <input type="submit" class="btn btn-warning text-white w-50" value="Filter">
                                </div>

                            </div>
                        </form>


                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Transactions</h3>
                                </div>

                                <!-- /.card-header -->
                                <div class="card-body">


                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Serial</th>
                                                <th>Type</th>
                                                <th>Year</th>
                                                <th>Month</th>
                                                <th>Company</th>
                                                <th>Project</th>
                                                <th>Note</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                                $total = 0;
                                            @endphp
                                            @foreach ($datas as $item)
                                                <?php
                                                $total = $total + $item->amount;
                                                ?>
                                                @if ($item->type == 'Income')
                                                    <tr style="color: green">
                                                    @else
                                                    <tr style="color: red">
                                                @endif
                                                <td>{{ $i }}</td>

                                                <td>{{ $item->type ?? '' }}</td>
                                                <td>{{ $item->year ?? '' }}</td>
                                                <td>{{ $item->month ?? '' }}</td>
                                                <td>{{ $item->company->name ?? '' }} - {{ $item->company->phone ?? '' }}
                                                </td>
                                                <td>{{ $item->project->name ?? '' }}</td>
                                                <td>{{ $item->note ?? '' }}</td>
                                                <td>{{ $item->amount ?? '' }}</td>

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
