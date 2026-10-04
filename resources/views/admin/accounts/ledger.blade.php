@extends('admin.layouts.app')
<title>Ledger</title>
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
                            <li class="breadcrumb-item active">Ledger</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">

                        <form action="{{ url('admin/filter_ledger') }}" method="get">
                            <div class="row mb-5">

                                <div class="col-md-4 ol-xl-4 ">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Year</label>
                                        <?php
                                        $year = date('Y');
                                        ?>
                                        <select name="year" id="" class="form-control" required>
                                            <option value="">Select</option>
                                            @for ($year == $year; $year > 2000; $year--)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 ol-xl-4 ">
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


                                <div class="col-xl-4 col-md-4">
                                    <label class="col-form-label">
                                        <p></p>
                                    </label><br>
                                    <input type="submit" class="btn btn-warning text-white w-50" value="Filter Ledger">
                                </div>

                            </div>
                        </form>

                    </div>

                    <div class="col-md-6">


                        <div class="card card-success">


                            <div class="card-header">
                                <h3 class="card-title" style="text-align: center !important">
                                    <b>
                                        Profit / Loss

                                    </b>
                                </h3>
                            </div>
                            <div class="">
                                <div class="card-body">
                                    <table id="exaple1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Serial</th>
                                                <th>Year</th>
                                                <th>Profit / Loss</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($profits as $item)
                                                <tr>


                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $item['year'] }}</td>
                                                    <td>
                                                        @if ($item['profit'] > 0)
                                                            Profit
                                                        @elseif($item['profit'] < 0)
                                                            Loss
                                                        @else
                                                            Equal
                                                        @endif
                                                    </td>
                                                    <td><b>{{ $item['profit'] }} /-</b></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title" style="text-align: center !important"><b>Total Income</b></h3>
                            </div>
                            <div class="">
                                <div class="card-body">
                                    <table id="exaple1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Serial</th>
                                                <th>Year</th>
                                                <th>Month</th>
                                                <th>Note</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                                $total = 0;
                                            @endphp
                                            @foreach ($income_trxs as $item)
                                                <?php
                                                $total = $total + $item->amount;
                                                ?>
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $item->year ?? '' }}</td>
                                                    <td>{{ $item->month ?? '' }}</td>
                                                    <td>{{ $item->note ?? '' }}</td>
                                                    <td>{{ $item->amount ?? '' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td><b>Total: </b></td>
                                                <td><b>{{ $total ?? 0 }} /-</b></td>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title" style="text-align: center !important"><b>Total Expense</b></h3>
                            </div>
                            <div class="">
                                <div class="card-body">
                                    <table id="exaple1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Serial</th>
                                                <th>Year</th>
                                                <th>Month</th>
                                                <th>Note</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                                $total = 0;
                                            @endphp
                                            @foreach ($expense_trxs as $item)
                                                <?php
                                                $total = $total + $item->amount;
                                                ?>
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $item->year ?? '' }}</td>
                                                    <td>{{ $item->month ?? '' }}</td>
                                                    <td>{{ $item->note ?? '' }}</td>
                                                    <td>{{ $item->amount ?? '' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td><b>Total: </b></td>
                                                <td><b>{{ $total ?? 0 }} /-</b></td>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    @include('admin.layouts.js_script_backend')
@endsection
