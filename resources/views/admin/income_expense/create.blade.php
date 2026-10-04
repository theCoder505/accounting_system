@extends('admin.layouts.app')
<title> Add Income/Expense</title>
<meta name="csrf-token" content="{{csrf_token()}}">
@section('content')



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
                        <li class="breadcrumb-item active">Add  Income/Expense</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
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
                            <h3 class="card-title">Add  Income/Expense</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('income_expense.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                
                            	<div class="row">
                            	
	                            	<div class="col-md-4">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Type<span style="color: red">*</span></label>
		                                    
		                                    <select name="type" id="type" class="form-control type " onchange="getIECategory(this.value)">
		                                    	<option value="">Select</option>
		                                    	<option value="Income">Income</option>
		                                    	<option value="Expense">Expense</option>
		                                    </select>
		                                </div>
	                            	</div>

                                                                	
	                            	<div class="col-md-4">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Category</label>
		                                    
		                                    <select name="income_expense_category_id" id="income_expense_category_id" class="form-control income_expense_category_id ">
		                                    	<option value="">Select</option>
		                                     
		                                    </select>
		                                </div>
	                            	</div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Date<span style="color: red">*</span></label>
                                            <input type="date" name="date" class="form-control" required>
                                        </div>
                                    </div>


	                            	 <div class="col-md-6" id="client_div">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Client</label>
		                                    
		                                    <select name="company_id" id="company_id" class="form-control company_id select2" onchange="getProjects(this.value)">
		                                    	<option value="">Select</option>
		                                        @foreach($companies as $item)
		                                        <option value="{{$item->id}}">{{$item->name}} - {{$item->phone}} </option>
		                                        @endforeach
		                                    </select>
		                                </div>
	                            	</div>
                            	
	                            	<div class="col-md-6" id="project_div">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Project</label>
		                                    
		                                    <select name="project_id" id="project_id" class="form-control project_id " onchange="getProjectDetails(this.value)">
		                                    	<option value="">Select</option>
		                                     
		                                    </select>
		                                </div>
	                            	</div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Title<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="title" required>
                                        </div>
                                    </div>

                                 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Total<span style="color: red">*</span></label>
                                            <input type="number" step="0.01" class="form-control" name="total" id="total"  required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Amount<span style="color: red">*</span></label>
                                            <input type="number" step="0.01" class="form-control" name="amount" id="amount" onkeyup="calculateIncomeExpenseDue(this.value)" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Due</label>
                                            <input type="number" step="0.01" class="form-control" name="due" id="due" readonly>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Note<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="note" value=""  required>
                                        </div>
                                    </div>

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
                <div class="col-md-3"></div>

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


        function calculateIncomeExpenseDue(val) {

            var total = $('#total').val();
            var due = total - val;

            $('#due').val(due);

        }

    </script>

@endsection