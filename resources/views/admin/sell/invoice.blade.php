<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            font-size: 12px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            position: relative;
            padding: 0;
            margin: 0;
        }
        .table {
            width: 100%;
        }
        .table, tr, td {
            border: 1px solid black;
            border-collapse: collapse;
            vertical-align: top;
        }
        .table td {
            padding: 4px;
        }
        .goods-table {
            margin-top: 5px;
        }
        /* .goods-table tbody {
            height: 1000px;
        } */
        .goods-table th,
        .goods-table td {
            padding: 3px 5px;
            border: 1px solid #000;
        }
        .goods-table tbody tr,
        .goods-table tbody tr td {
            border-top: none;
            border-bottom: none;
        }
        .border-none {
            border: none;
        }
        .border-none-tr,
        .border-none-tr td {
            border: none;
        }
        #heading_table, #heading_table tr, #heading_table tr td{
            border: none !important;
        }

        table.cst,table.cst th, table.cst tr, table.cst tr, table.cst td{
            height:15px !important;
            font-size:12px;
            border-color: #b1b1b1;
            border-width: thin;
        }
        
        .fixed-bottom {
            position: fixed;
            bottom: 24px;
            right: 5px;
        }
        
        #sign{
            position: fixed;
            width: 100%;
            bottom:80px;
            left:0;
            margin:0
            padding:0;
        }
    </style>
</head>

<body>
    <div>

        <table id="heading_table" class="table" style="margin-bottom:0px;margin-top:80px;">
            <thead>

                <tr>
                    <td>To:</td>
                    <td colspan="6"></td>
                    <td colspan="5" style="text-align:right"></td>
                </tr>
                <tr>
                    <td>Customer Name: {{ $data->company->name ?? ''}}</td>
                </tr>
                <tr>
                    <td>Address: {{ $data->company->address ?? ''}}</td>
                    <td colspan="6"></td>
                    <td colspan="5" style="text-align:right">Invoice Date: {{ Carbon\Carbon::parse($data->date)->format('d M Y') }} </td>
                </tr>
                <tr>
                    <td>Invoice id: {{ $data->invoice_id ?? ''}}</td>
                    <td colspan="6"></td>
                    <td colspan="5" style="text-align:right">Customer Phone: {{ $data->company->phone ?? ''}}</td>
                </tr>
           
            </thead>
        </table>
        <h4 style="font-size:20px;text-align:center; margin:0 0;">Sales Invoice</h4>

        <br>
        <table class="table cst">
            <thead>
                <tr>
                    <td style="text-align:center" >SL. No.</td>
                    <td style="text-align:center" colspan="4">Book Name</td>
                    <td style="text-align:center">Qty/Pcs</td>
                    <td style="text-align:center; width:60px">Unit Price</td>
                    <td style="text-align:center; width:70px">Amount</td>
                </tr>
            </thead>
            <tbody>

                @php 
                    $i=1; 
                    $sub_total_amount = 0;
                    $sub_total_subtotal = 0;
                @endphp
                @foreach($products as $item)

                @php 
                    $sub_total_amount += $item->amount;
                    $sub_total_subtotal += $item->subtotal;
                @endphp

                <tr>
                    <td style="text-align:center">{{$i++}}</td>
                    <td colspan="4" style="font-family: nikosh; font-size: 17px">{{$item->product->name ?? ''}}</td>
                    <td style="text-align:center">{{$item->qty ?? '0'}}</td>
                    <td style="text-align:center">
                        
                        
                        <?php
                        
                            $userunit_priceAmount = $item->unit_price;
    
                            $formattedAmount = str_replace(',', '', number_format($userunit_priceAmount, 2));
          
                            $decimalPart = fmod($userunit_priceAmount, 1);
                
                            if ($decimalPart > 0.01) {
                                $unit_price = $formattedAmount;
                            } else {
                                $unit_price = floor($userunit_priceAmount);
                            }

                        ?>

                        {{$unit_price ?? '0'}}
                        
                        </td>
                    <td style="text-align:center">
                        
                                                
                        <?php
                        
                            $userAmount = $item->amount;
    
                            $formattedAmount = str_replace(',', '', number_format($userAmount, 2));
          
                            $decimalPart = fmod($userAmount, 1);
                
                            if ($decimalPart > 0.01) {
                                $amount = $formattedAmount;
                            } else {
                                $amount = floor($userAmount);
                            }

                        ?>
                        
                        {{$amount ?? '0'}}
                        
                        
                        </td>
              
                
                </tr>


                @endforeach

          
            </tbody>
            <tfoot>
              
                <tr>
                    <td colspan="2" rowspan="4"></td>
                    <td colspan="4">Invoice Amount</td>
                    <td style="text-align:right" colspan="2">
                        
                        
                                                                                                
                        <?php
                        
                            $usertotalAmount = $data->total;
    
                            $formattedAmount = str_replace(',', '', number_format($usertotalAmount, 2));
          
                            $decimalPart = fmod($usertotalAmount, 1);
                
                            if ($decimalPart > 0.01) {
                                $total = $usertotalAmount;
                            } else {
                                $total = floor($usertotalAmount);
                            }

                        ?>
                        
                        
                        {{$total ?? 0}}
                        
                        
                        </td>
                </tr>
                <tr>
                
                    <td colspan="4">
                        
                        
                        Discount 
                        
                          
                        ( {{$data->discount_percentage ?? 0}} %)
                        
                        
                    </td>
                    <td style="text-align:right" colspan="2">
                        
                                                                        
                        <?php
                        
                            $usertotal_discountAmount = $data->total_discount_amount;
    
                            $formattedAmount = str_replace(',', '', number_format($usertotal_discountAmount, 2));
          
                            $decimalPart = fmod($usertotal_discountAmount, 1);
                
                            if ($decimalPart > 0.01) {
                                $total_discount = $usertotal_discountAmount;
                            } else {
                                $total_discount = floor($usertotal_discountAmount);
                            }

                        ?>
                        
                        {{$total_discount ?? 0}}   
                    </td>
                </tr>
                <tr>
           
                    <td colspan="4">Pay</td>
                    <td style="text-align:right" colspan="2">
                        
                        
                                                                                                                        
                        <?php
                        
                            $userpayAmount = $data->pay;
    
                            $formattedAmount = str_replace(',', '', number_format($userpayAmount, 2));
          
                            $decimalPart = fmod($userpayAmount, 1);
                
                            if ($decimalPart > 0.01) {
                                $pay = $userpayAmount;
                            } else {
                                $pay = floor($userpayAmount);
                            }

                        ?>
                        
                        
                        {{$pay ?? 0}}
                        
                        
                    </td>
                </tr>
                <tr>
         
                    <td colspan="4"> Due </td>
                    <td style="text-align:right" colspan="2">

                        <?php
                        
                            $userdueAmount = $data->due;
    
                            $formattedAmount = str_replace(',', '', number_format($userdueAmount, 2));
          
                            $decimalPart = fmod($userdueAmount, 1);
                
                            if ($decimalPart > 0.01) {
                                $due = $userdueAmount;
                            } else {
                                $due = floor($userdueAmount);
                            }

                        ?>

                        {{$due ?? 0}}
                        
                    </td>
                </tr>
            </tfoot>
        </table>
        {{-- <p style="text-align: center; font-size: 14px;"><strong style="font-weight:bold">Taka In Word:</strong> {{ ucfirst($total_text) }} only</p> --}}
        


        <p class="fixed-bottom" style="text-align: center; font-size: 12px;">This is a Computer Generated Invoice</p>
    </div>
</body>

</html>