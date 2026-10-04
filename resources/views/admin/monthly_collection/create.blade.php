@extends('admin.layouts.app')
<title> Add monthly collection</title>
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
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Add monthly collection</li>
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
                        <div class="card-header">
                            <h3 class="card-title">Add  monthly collection</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('monthly_collection.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                
                            	<div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Year</label>
                                            <?php 
                                                // $year = date('Y');
                                                $year = 2030;
                                            ?>
                                            <select name="year" id="" class="form-control">
                                                @for($year == $year; $year > 2000; $year--)
                                                    <option value="{{$year}}">{{$year}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                
	                            	<div class="col-md-3">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Customer</label>
		                                    <select name="company_id" class="form-control company_id select2" id="" onchange="getCompanyDetails(this.value)">
                                                <option value="" selected>Select</option>
                                                @foreach($companies as $company)
                                                <option value="{{$company->id}}" >{{$company->name}}</option>
                                                @endforeach    
                                            </select>
		                                </div>
                            		</div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone Number</label>
                                            <input type="text" class="form-control company_number" name="" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Per month amount</label>
                                            <input type="text" class="form-control per_month_amount" name="per_month_amount" readonly>
                                        </div>
                                    </div>

                                    

                            	</div>

                                <div class="col-sm-12">
                                    <label for="inputEmail3" class="col-form-label">Products</label>
                                    <table class="table table-striped product-item-table">
                                        <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>Total Amount</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="sellProduct">
                                            <tr class="product-item-row">
                                             
                                                <td>
                                                    <select name="month[]" id="" class="form-control">
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
                                                </td>
                                           
                                            
                                                <td>
                                                    <input type="number" step="0.1"  class="form-control  amount" name="amount[]" readonly>
                                                </td>
                                           
                                            
                                                <td>
                                                    <input type="date" class="form-control" name="date[]" value="{{ date('Y-m-d') }}" required>
                                                </td>
                                           
                                              
                                                <td>
                                                    <button id="addMonthRow"  type="button" class="btn btn-light btn-sm addMonthRow "><i class="fa fa-plus-circle"></i>  
                                                    </button>   
                                                </td>                                              
                                            </tr>

                                        </tbody>
                                        <tfoot>


                                            <tr>
                                                <td></td>
                                                <td style="text-align: right;">
                                                    <span class=""><strong>Total amount</strong></span>
                                                </td>
                                                <td>
                                                    <input type="number"  step="0.1" name="total" id="total" class="form-control" readonly required >
                                                </td>
                                            </tr>


                                            <tr>
                                                <td></td>

                                                <td style="text-align: right;">
                                                    <span class=""><strong>Total due</strong></span>
                                                </td>
                                                <td>
                                                    <input type="number"  step="0.1" name="due" id="due" class="form-control" readonly required >
                                                </td>
                                            </tr>

                                        
                                        </tfoot>

                                    </table>   

                                     
                                </div>



                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (left) -->

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

<script>
    

    $(document).on('click', '.addMonthRow', function(){
        var html = `
        <tr class="product-item-row">
            <td>
                <select name="month[]" id="" class="form-control">
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
            </td>
        
            <td>
                <input type="number" step="0.1" class="form-control  amount" name="amount[]" readonly>
            </td>
        
            <td>
                <input type="date" class="form-control" name="date[]" value="{{ date('Y-m-d') }}" required>
            </td>

            <td>
                <button id="addMonthRow" type="button" class="btn btn-light btn-sm addMonthRow "><i class="fa fa-plus-circle"></i>  
                </button>   

                <button id="" type="button" class="btn btn-light btn-sm remove "><i class="fa fa-minus-circle"></i>  
                </button>   
            </td>                                              
        </tr>
        `;
        $('#sellProduct').append(html);
    });

    $(document).on('click', '.remove', function(){
      $(this).closest('tr').remove();
    });


    $('body').on('change', 'select[name="month[]"]', function () {

        console.log($(this).val());

        var company_id = $('.company_id').val();
        if(!company_id){
            alert('Please select customer!')
        }
        var per_month_amount = $('.per_month_amount').val();

        var amount = $(this).closest('td').closest('.product-item-row').find('.amount');

        amount.val(per_month_amount);

        var totalAmount = 0;

        $('.product-item-row').each(function () {
            totalAmount += parseFloat($(this).find('.amount').val()) || 0;
        });

        $('#total').val(totalAmount.toFixed(2));

        var total_amount = per_month_amount * 12;
        var due = total_amount - totalAmount;

        $('#due').val(due.toFixed(2));

    });


</script>








@endsection