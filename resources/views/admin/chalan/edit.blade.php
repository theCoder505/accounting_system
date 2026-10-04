@extends('admin.layouts.app')
<title> Edit Chalan</title>
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
                        <li class="breadcrumb-item active">Edit Chalan</li>
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
                            <h3 class="card-title">Edit Chalan</h3>
                        </div>
                        <!-- /.card-header -->
                

                        <form action="{{route('chalan.update',$data->id)}}" method="post"  enctype="multipart/form-data">
                            @method('patch')
                            @csrf


                            <div class="card-body">
                                
                            	<div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Invoice Id</label>
                                            <input type="text" class="form-control" name="invoice_id" value="{{ $data->invoice_id }}" readonly>
                                        </div>
                                    </div>

	                            	<div class="col-md-4">
		                                <div class="form-group">
		                                    <label for="exampleInputEmail1">Company <span style="color: red;">*</span> </label>
		                                    <select name="company_id" class="form-control select2" id="" onchange="getCompanyDetails(this.value)">
                                                <option value="" selected>Select</option>
                                                @foreach($companies as $company)
                                                <option value="{{$company->id}}"  @php if ($data['company_id'] == $company->id) { echo "selected"; } @endphp>{{$company->name}}</option>
                                                @endforeach    
                                            </select>
		                                </div>
                            		</div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Company Number</label>
                                            <input type="text" class="form-control company_number" name="company_number" value="{{ $data->company->address ?? '' }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Company Address</label>
                                            <input type="text" class="form-control company_address" name="company_address" value="{{ $data->company->phone ?? '' }}" readonly>
                                        </div>
                                    </div>


                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Date <span style="color: red;">*</span> </label>
                                            <input type="date" name="date" value="{{ $data->date }}"   class="form-control" required>
                                        </div>
                                    </div>


                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Delivery Site</label>
                                            <input type="text" name="delivery_site" value="{{ $data->delivery_site }}"  class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Project Name</label>
                                            <input type="text" name="project_name" value="{{ $data->project_name }}"  class="form-control">
                                        </div>
                                    </div>

                                   <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Sale's Ref</label>
                                            <input type="text" name="sale_ref" value="{{ $data->sale_ref }}"  class="form-control">
                                        </div>
                                    </div>


                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Contact</label>
                                            <input type="text" name="contact" value="{{ $data->contact }}"  class="form-control">
                                        </div>
                                    </div> 

                                    
                                    

                            	</div>

                                <div class="col-sm-12">
                                    <label for="inputEmail3" class="col-form-label">Products</label>
                                    <table class="table table-striped product-item-table" id="sellProduct">
                                        <thead>
                                        <tr>
                                            <th>Product <span style="color: red;">*</span> </th>
                                            <th>Product Code</th>
                                            <th>Order Qty <span style="color: red;">*</span> </th>
                                            <th>Remarks</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($chalan_products as $item)
                                            <?php
                                                $product = App\Models\Product::where('id', $item->product_id)->first();
                                            ?>
                                            <tr class="product-item-row">

                                                <td style="width: 400px;">

                                                    <input type="text" class="form-control product_name" name="product_name[]" value="{{ $product->name }}" placeholder="Type product name" required>


                                                    <input type="text" class="form-control product_id" name="product_id[]" value="{{ $product->id }}" hidden >



                                                    <div class="product_ul">
                                                        
                                                    </div>

                                                </td>

                                                <td>
                                                    <input type="text" class="form-control product_code" name="product_code" value="{{ $item->product->code ?? '' }}"  readonly>
                                                </td>

                                                <td>
                                                    <input type="number" class="form-control order_qty " name="order_qty[]" value="{{ $item->order_qty }}"  onkeyup="calculateTotal(this.value)">
                                                </td>

                                                <td>
                                                    <input type="text" class="form-control remarks " name="remarks[]" value="{{ $item->remarks }}" >
                                                </td>
                                              
                                                <td>
                                                    <button id="addSellProductRow"  type="button" class="btn btn-light btn-sm addSellProductRow"><i class="fa fa-plus-circle"></i>  
                                                    </button>   
                                                </td>    

                                            </tr>
                                            @endforeach

                                        </tbody>
                                        <tfoot>
                                            
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td style="text-align: right;">
                                                <span class=""><strong>Total <span style="color: red;">*</span> </strong></span>
                                            </td>
                                            <td>
                                                <input type="number" name="total" class="form-control total" value="{{ $data->total }}"  required >
                                            </td>
                                        </tr>

                                     
                                 
                                        </tfoot>

                                    </table>   

                                     
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
    

    $(document).on('click', '.addSellProductRow', function(){
        var html = `

            <tr class="product-item-row">
                <td style="width: 400px;">

                    <input type="text" class="form-control product_name" name="product_name[]" placeholder="Type product name" >

                    <input type="text" class="form-control product_id" name="product_id[]" hidden >


                    <div class="product_ul">
                        
                    </div>

                </td>
                <td>
                    <input type="text" class="form-control product_code" name="product_code" readonly>
                </td>
                <td>
                    <input type="number" class="form-control order_qty " name="order_qty[]" onkeyup="calculateTotal(this.value)">
                </td>
                <td>
                    <input type="text" class="form-control remarks " name="remarks[]">
                </td>
              
                <td>
                    <button id="addSellProductRow"  type="button" class="btn btn-light btn-sm addSellProductRow"><i class="fa fa-plus-circle"></i>  
                    </button>   

                    <button type="button" name="remove" class="btn btn-light btn-sm remove"><span class="fa fa-minus-circle"></span></button>
                </td>                                              
            </tr>

        `;
        $('#sellProduct').append(html);
    });

    $(document).on('click', '.remove', function(){
      $(this).closest('tr').remove();
    });



    $(document).on('click', '.remove', function(){
      $(this).closest('tr').remove();
    });
    

        // $('body').on('input', '.product-select', function () {
        $('body').on('input', 'input[name="product_name[]"]', function () {

            var search = $(this).val();
            var productUl = $(this).closest('td').find('.product_ul');

            var product_id_feild = $(this).closest('td').closest('.product-item-row').find('.product_id');
            var product_name_feild = $(this).closest('td').closest('.product-item-row').find('.product_name');



            product_name = product_name_feild.val();
            product_length = product_name.length;


            if(product_length > 0){
                // Make an AJAX request to get filtered products
                $.ajax({
                    url: '<?php echo route('admin/get-products', ['search' => '__search__']); ?>'.replace('__search__', search),
                    type: 'GET',
                    success: function (data) {
                        product_id_feild.val('');


                        productUl.show();
                       updateProductList(productUl, data);
                    },
                    error: function () {
                        console.log('Error fetching products.');
                    }
                });
            }


            if(product_length == 0){
                productUl.hide();
            }


        });


        function updateProductList(productUl, data) {
            // Clear existing list items
            productUl.empty();
            productUl.append(data);
        }

    $(document).ready(function () {
        // Add click event listener to list items
        $('#sellProduct').on('click', '.product_ul li', function () {

            var productId = $(this).data('id');

            console.log(productId);


            var product_code_feild = $(this).parents('ul').closest('.product-item-row').find('.product_code');
            var product_name_feild = $(this).parents('ul').closest('.product-item-row').find('.product_name');
            var product_id_feild = $(this).parents('ul').closest('.product-item-row').find('.product_id');



            var product_ul =  $(this).parents('ul').parents('.product_ul');
            console.log(product_code_feild);


            // Make an AJAX request to get product details
            $.ajax({
                 url: '<?php echo route('admin/get-product-details', ['productId' => '__productId__']); ?>'.replace('__productId__', productId),
                type: 'GET',
                success: function (data) {


                    product_code_feild.val(data.product.code);
                    product_name_feild.val(data.product.name);
                    product_id_feild.val(data.product.id);

                    product_ul.hide();

                },
                error: function () {
                    console.log('Error fetching product details.');
                }
            });
        });
    });


    function calculateTotal(value) {
        // Assuming you have only one total input field
        var totalInput = document.querySelector('input[name="total"]');
        
        // Get all order_qty input fields
        var orderQtyInputs = document.querySelectorAll('.order_qty');
        
        // Calculate the total quantity
        var totalQuantity = 0;
        orderQtyInputs.forEach(function (input) {
            totalQuantity += parseInt(input.value) || 0;
        });
        
        // Update the total input field
        totalInput.value = totalQuantity;
    }

    // Add event listeners to all order_qty inputs
    var orderQtyInputs = document.querySelectorAll('.order_qty');
    orderQtyInputs.forEach(function (input) {
        input.addEventListener('keyup', function () {
            calculateTotal(this.value);
        });
    });


</script>

@endsection