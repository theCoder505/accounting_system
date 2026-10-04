@extends('admin.layouts.app')
<title> Edit Sell</title>
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
                        <li class="breadcrumb-item active">Edit Sell</li>
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
                            <h3 class="card-title">Edit Sell</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('sell.update',$data->id)}}" method="post"  enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="card-body">
                                
                            	<div class="row">



                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Invoice Date</label>
                                            <input type="date" class="form-control" name="date" value="{{ $data->date }}" required>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Company</label>
                                            <select name="company_id" class="form-control select2" id="" onchange="getCompanyDetails(this.value)">
                                                <option value="" selected>Select</option>
                                                @foreach($companies as $company)
                                                <option value="{{$company->id}}" @php if ($data['company_id'] == $company->id) { echo "selected"; } @endphp>{{$company->name}}</option>
                                                @endforeach    
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Company Number</label>
                                            <input type="text" class="form-control company_number" name="company_number" value="{{ $data->company->address ?? '' }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Company Address</label>
                                            <input type="text" class="form-control company_address" name="company_address" value="{{ $data->company->phone ?? '' }}" readonly>
                                        </div>
                                    </div>

                                    <!--<div class="col-md-3">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <label for="exampleInputEmail1">Invoice Id</label>-->
                                    <!--        <input type="text" class="form-control" name="invoice_id" value="{{ $data->invoice_id }}" readonly>-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                   

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label> Payment Method</label>
                                            <select class="custom-select select2" name="payment_method">
                                                <option value="">Select</option>
                                                <option value="Cash" @php if ($data['payment_method'] == 'Cash') { echo "selected"; } @endphp>Cash</option>
                                                <option value="Bkash" @php if ($data['payment_method'] == 'Bkash') { echo "selected"; } @endphp>Bkash</option>
                                                <option value="Nagad" @php if ($data['payment_method'] == 'Nagad') { echo "selected"; } @endphp>Nagad</option>
                                                <option value="Rocket" @php if ($data['payment_method'] == 'Rocket') { echo "selected"; } @endphp>Rocket</option>
                                                <option value="Bank" @php if ($data['payment_method'] == 'Bank') { echo "selected"; } @endphp>Bank</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Delivery Note</label>
                                            <input type="text" name="delivery_note" value="{{ $data->delivery_note ?? '' }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Supplier’s Ref</label>
                                            <input type="text" name="supplier_ref" value="{{ $data->supplier_ref ?? '' }}" class="form-control">
                                        </div>
                                    </div>
 -->

                                    {{-- <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Other Reference(s)</label>
                                            <input type="text" name="other_ref" class="form-control" value="{{ $data->other_ref ?? '' }}">
                                        </div>
                                    </div> --}}



                                    <div class="col-sm-3" style="display: none">
                                        <div class="form-group">
                                            <label> Status</label>
                                            <select class="custom-select select2" name="status">
                                                <option value="Pending"  @php if ($data['status'] == 'Pending') { echo "selected"; } @endphp>Pending</option>
                                                <option value="Processing" @php if ($data['status'] == 'Processing') { echo "selected"; } @endphp>Processing</option>
                                                <option value="Completed" @php if ($data['status'] == 'Completed') { echo "selected"; } @endphp>Completed</option>
                                            </select>
                                        </div>
                                    </div>

                            	</div>

                                <div class="col-sm-12">
                                    <label for="inputEmail3" class="col-form-label">Products</label>
                                    <table class="table table-striped product-item-table">
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>A.Qty</th>
                                            <th>Qty/Pcs</th>
                                            <th>Unit Price</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="sellProduct">

                                            @foreach($sell_products as $item)

                                            <?php
                                                $product = App\Models\Product::where('id', $item->product_id)->first();
                                            ?>

                                            <tr class="product-item-row">

                                                <td style="width: 350px;">

                                                    <input type="text" class="form-control product_name" name="product_name[]" value="{{ $product->name }}" placeholder="Type product name" required>


                                                    <input type="text" class="form-control product_id" name="product_id[]" value="{{ $product->id }}" hidden >



                                                    <div class="product_ul">
                                                        
                                                    </div>

                                                </td>
                                               
                                                <td>
                                                    <input type="number" class="form-control available_qty" name="available_qty"  value="{{ $item->product->qty ?? '' }}"  readonly>
                                                </td>


                                                <td>
                                                    <input type="number" class="form-control product_quantity" value="{{ $item->qty }}" name="qty[]" onkeyup="calculateRowSubtotal(this)">
                                                </td>

                                                <td>
                                                    <input type="number" class="form-control unit_price" value="{{ $item->unit_price }}" name="unit_price[]" readonly>
                                                </td>

                                                <td style="display: none">
                                                    <input type="text" class="form-control amount" value="{{ $item->amount }}" name="amount[]" readonly>
                                                </td>
                                              

                                                <td>
                                                    <input type="text" class="form-control subtotal" value="{{ $item->subtotal }}" name="subtotal[]" readonly>
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
                                                <td></td>
                                                <td style="text-align: right;">
                                                    <span class=""><strong>Total </strong></span>
                                                </td>
                                                <td>
                                                    <input type="number"  step="0.1" name="tttt_total" id="tttt_total" value="{{ $data->total }}"  class="form-control" readonly required >
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>


                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td style="text-align: right;">
                                                    <span class=""><strong>Discount (%)</strong></span>
                                                </td>
                                                <td>
                                                    <input type="number" name="discount_percentage" value="{{ $data->discount_percentage }}"  id="" class="form-control" value="" onkeyup="calculateDiscount(this.value)">
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td style="text-align: right;">
                                                    <span class=""><strong>Discount amount (-)</strong></span>
                                                </td>
                                                <td>
                                                    <input type="number" name="total_discount_amount" value="{{ $data->total_discount_amount }}" id="total_discount" class="form-control" value="0" onkeyup="calculateDue(this.value)" readonly>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>


                                            <tr style="display: none">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td style="text-align: right;">
                                                    <span class=""><strong>Total invoice amount</strong></span>
                                                </td>
                                                <td>
                                                    <input type="text" step="0.1" name="total" id="total" value="{{ $data->total }}" class="form-control" readonly required>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>


                                             <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td style="text-align: right;">
                                                    <span class=""><strong>Pay</strong></span>
                                                </td>
                                                <td>
                                                    <input type="text" step="0.1"  name="pay" id="pay" value="{{ $data->pay }}" class="form-control" readonly required onkeyup="calculatePayToDue(this.value)">
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                             {{-- <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td style="text-align: right;">
                                                    <span class=""><strong>Due</strong></span>
                                                </td>
                                                <td>
                                                    <input type="text" step="0.1" name="due" id="due" value="{{ $data->due }}" class="form-control" readonly required>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr> --}}


                                        </tfoot>

                                    </table>   

                                     
                                </div>



                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                @if($data->status == 'Completed')
                                    <button type="button" class="btn btn-danger" onclick="alert('Already completed !! You can not edit now')">Update</button>
                                @else
                                    <button type="submit" class="btn btn-primary">Update</button>
                                @endif
                                
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
                <td style="width: 350px;">
                    <input type="text" class="form-control product_name" name="product_name[]" placeholder="Type product name" required>
    
    
                    <input type="text" class="form-control product_id" name="product_id[]" hidden>
    
    
    
                    <div class="product_ul">
                        
                    </div>
    
                </td>
                <td>
                    <input type="number" class="form-control available_qty " name="available_qty" readonly>
                </td>
    
                <td>
                    <input type="number" class="form-control product_quantity " name="qty[]" onkeyup="calculateRowSubtotal(this)">
                </td>
                <td>
                    <input type="number" step="0.1"  class="form-control  unit_price" name="unit_price[]" readonly>
                </td>
                <td style="display: none">
                    <input type="number" step="0.1"  class="form-control  amount" name="amount[]" readonly>
                </td>
       
            
                
                <td>
                    <input type="text" step="0.1"  class="form-control subtotal" name="subtotal[]" readonly>
                </td>
                <td>
                    <button id="addSellProductRow"  type="button" class="btn btn-light btn-sm addSellProductRow "><i class="fa fa-plus-circle"></i>   </button>  
    
                    <button id=""  type="button" class="btn btn-light btn-sm remove "><i class="fa fa-minus-circle"></i>   </button>   
                </td>                                              
            </tr>
            `;
            $('#sellProduct').append(html);
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
    
    
                var product_available_qty_feild = $(this).parents('ul').closest('.product-item-row').find('.available_qty');
                var product_name_feild = $(this).parents('ul').closest('.product-item-row').find('.product_name');
                var product_id_feild = $(this).parents('ul').closest('.product-item-row').find('.product_id');
                var product_selling_price_feild = $(this).parents('ul').closest('.product-item-row').find('.unit_price');
    
    
    
                var product_ul =  $(this).parents('ul').parents('.product_ul');
    
    
                // Make an AJAX request to get product details
                $.ajax({
                     url: '<?php echo route('admin/get-product-details', ['productId' => '__productId__']); ?>'.replace('__productId__', productId),
                    type: 'GET',
                    success: function (data) {
    
    
                        product_available_qty_feild.val(data.product.qty);
                        product_name_feild.val(data.product.name);
                        product_id_feild.val(data.product.id);
                        product_selling_price_feild.val(data.product.selling_price);
    
                        product_ul.hide();
    
                    },
                    error: function () {
                        console.log('Error fetching product details.');
                    }
                });
            });
        });
    
    
    
    </script>
    
    
    
    <script>
        // Function to calculate subtotal for a given row
        function calculateRowSubtotal(row) {
    
            var quantity = parseFloat($(row).find('.product_quantity').val()) || 0;
            var unitPrice = parseFloat($(row).find('.unit_price').val()) || 0;
            var discount = parseFloat($(row).find('.discount').val()) || 0;
    
    
            var amount = quantity * unitPrice;
             
    
            $(row).find('.amount').val(amount.toFixed(2));
            $(row).find('.subtotal').val(amount.toFixed(2));
    
    
            updateTotalDiscount(); 
    
      
        }
    
        function updateTotalDiscount() {
            var totalDiscount = 0;
    
            $('.product-item-row').each(function () {
                totalDiscount += parseFloat($(this).find('.discount').val()) || 0;
            });
    
            // Display the total discount in a field with the id "total_discount"
            $('#total_discount').val(totalDiscount.toFixed(2));
        }
    
    
        // Function to update total based on all rows
        function updateTotal() {
            var total = 0;
            var totalDiscount = 0;
    
            $('.product-item-row').each(function () {
                total += parseFloat($(this).find('.subtotal').val()) || 0;
            });
    
            $('#tttt_total').val(total.toFixed(2));
            $('#total').val(total.toFixed(2));
            $('#pay').val(total.toFixed(2));
    
            $('#total_discount').val(totalDiscount.toFixed(2));
        }
    
        // Event handler for unit_price keyup using event delegation
        $(document).on('keyup', '.product_quantity', function () {
            var row = $(this).closest('.product-item-row');
            calculateRowSubtotal(row);
            updateTotal();
            updateTotalDiscount();
    
        });
    
    
    
        function calculateDue(val){
            var discount = val;
    
            var total = $('#total').val();
    
            var due = total - discount;
            $('#due').val(due);
    
        }
    
        function calculatePayToDue(val){
            var pay = val;
            var total = $('#total').val();
            
    
            var due = parseFloat(total) - parseFloat(pay);
    
            $('#due').val(parseFloat(due));
        }
    
        function calculateDiscount(val){
            var discountPercentage = val;
            var tttt_total = $('#tttt_total').val();
    
            var discountAmount = (tttt_total * (discountPercentage / 100));
    
            var total_invoice_amount = tttt_total - discountAmount;
    
            $('#total_discount').val(discountAmount.toFixed(2));
            $('#total').val(total_invoice_amount.toFixed(2));
            $('#pay').val(total_invoice_amount.toFixed(2));
    
           
        }
    
    
    </script>
    



@endsection