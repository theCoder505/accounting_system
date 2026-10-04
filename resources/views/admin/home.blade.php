@extends('admin.layouts.app')
@section('content')

<?php  
    $adminId = Session::get('adminId');
    $admin = App\Models\Admin::where('id', $adminId)->first();
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
   
        <div class="row">



          <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
              <div class="inner">

                <?php
                  $total_income_amount = App\Models\IncomeExpense::where('type', 'Income')->sum('amount');
                ?>


                <h3>{{$total_income_amount}} /-</h3>

                <p>Total income amount (Paid)</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{URL::to('admin/income_expense')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
              <div class="inner">

                <?php
                  $total_income_amount_due = App\Models\IncomeExpense::where('type', 'Income')->sum('due');
                ?>


                <h3>{{$total_income_amount_due}} /-</h3>

                <p>Total income amount (Due)</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{URL::to('admin/income_expense')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
              <div class="inner">

                <?php
                  $total_transactions = App\Models\Transaction::sum('amount');
                ?>


                <h3>{{$total_transactions}} /-</h3>

                <p>Total Transactions</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{URL::to('admin/all_transaction')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>




          <div class="col-lg-6 col-6">

            <div class="small-box bg-success">
              <div class="inner">

                <?php
                  $total_income = App\Models\Transaction::where('type', 'Income')->sum('amount');
                ?>


                <h3>{{$total_income}} /-</h3>

                <p>Total Income</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-6">

            <div class="small-box bg-danger">
              <div class="inner">

                <?php
                  $total_expense = App\Models\Transaction::where('type', 'Expense')->sum('amount');
                ?>


                <h3>{{$total_expense}} /-</h3>

                <p>Total Expense</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-12 col-12">

            <?php
              $profit = $total_income - $total_expense;
            ?>

          @if ($profit > 0)
          <div class="small-box bg-success">
          @else
          <div class="small-box bg-danger">
          @endif
            
              <div class="inner">



                <h3>{{$profit}} /-</h3>

                
                @if ($profit > 0)
                  <p>Profit</p>
                @elseif($profit < 0)
                  <p>Loss</p>
                @else
                  <p>Equal</p>
                @endif


              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>

          <!-- ./col -->


  

        </div>
        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @stop