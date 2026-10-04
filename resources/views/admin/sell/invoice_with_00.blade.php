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
                    <td>Address: {{ $data->company->address ?? ''}}</td>
                    <td colspan="6"></td>
                    <td colspan="5" style="text-align:right">Invoice Date: {{ Carbon\Carbon::parse($data->date)->format('d M Y') }} </td>
                </tr>
                <tr>
                    <td>Challan no: {{ $data->chalan->invoice_id ?? ''}}</td>
                    <td colspan="6"></td>
                    <td colspan="5" style="text-align:right">Client Code: {{ $data->company->code ?? ''}}</td>
                    
                </tr>
                <tr>
                    <td>Sales Ref: {{ $data->chalan->sale_ref ?? ''}}</td>
                    <td colspan="6"></td>
                    {{-- <td>Product:</td> --}}
                   <td colspan="5" style="text-align:right">Contact: {{ $data->company->phone ?? ''}}</td>
                </tr>
            </thead>
        </table>
        <h4 style="font-size:20px;text-align:center; margin:0 0;">Sales Invoice</h4>

        <br>
        <table class="table cst">
            <thead>
                <tr>
                    <td style="text-align:center" >SL. No.</td>
                    <td style="width:40px">Prod Code</td>
                    <td style="text-align:center" colspan="4">Description/Item</td>
                    <td style="text-align:center">Qty/Pcs</td>
                    <td style="text-align:center; width:60px">Unit Price</td>
                    <td style="text-align:center; width:70px">Amount</td>
                    <td style="text-align:center;width:70px">Discount</td>
                    <td style="text-align:right" colspan="2">Total Invoice</td>
                </tr>
            </thead>
            <tbody>

                @php 
                    $i=1; 
                    $amount = 0;
                    $discount = 0;
                    $subtotal = 0;
                @endphp
                @foreach($products as $item)

                @php 
                    $amount += $item->amount;
                    $discount += $item->discount;
                    $subtotal += $item->subtotal;
                @endphp

                <tr>
                    <td style="text-align:center">{{$i++}}</td>
                    <td>{{$item->product->code ?? ''}}</td>
                    <td colspan="4">{{$item->product->name ?? ''}}</td>
                    <td style="text-align:center">{{$item->qty ?? '0'}}</td>
                    <td style="text-align:center">{{$item->unit_price ?? '0'}}</td>
                    <td style="text-align:center">{{$item->amount ?? '0'}}</td>
                    <td style="text-align:center">{{$item->discount ?? '0'}}</td>
                    <td style="text-align:right" colspan="2">{{$item->subtotal ?? '0'}}</td>
                </tr>


                @endforeach

          
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="4"></td>
                    <td></td>
                    <td></td>
                    <td  style="text-align:center">{{ $amount ?? 0 }}</td>
                    <td  style="text-align:center">{{ $discount ?? 0 }}</td>
                    <td style="text-align:right" colspan="2">{{ $subtotal ?? 0 }}</td>
                </tr>
                <tr>
                    <td colspan="6" rowspan="4"></td>
                    <td colspan="4">Invoice Amount</td>
                    <td style="text-align:right" colspan="2">{{$data->total ?? 0}}</td>
                </tr>
                <tr>
                
                    <td colspan="4">
                        
                        
                        Discount Amount
                        
                          
                        (
                        
                        @foreach($products as $key => $item)
                        
                            <span>{{ $item->discount_percentage ?? 0 }}%{{ $key < count($products) - 1 ? ',' : '' }}</span>
                        
                        @endforeach
                        
                        )
                        
                        
                    </td>
                    <td style="text-align:right" colspan="2">
                        {{$data->total_discount ?? 0}}   </td>
                </tr>
                <tr>
           
                    <td colspan="4">Freight</td>
                    <td style="text-align:right" colspan="2">{{$data->pay ?? 0}}</td>
                </tr>
                <tr>
         
                    <td colspan="4"> Total invoice Amount</td>
                    <td style="text-align:right" colspan="2">{{$data->due}}</td>
                </tr>
            </tfoot>
        </table>
        <p style="text-align: center; font-size: 14px;"><strong style="font-weight:bold">Taka In Word:</strong> {{ ucfirst($total_text) }} only</p>
        
        <table id="sign" class="table"  style="border:none !important;">
            <tr style="border:none !important">
                <td style="border:none !important; text-align:left; font-size:12px;">Checked by</td>
                <td style="border:none !important; text-align:center; font-size:12px;">Approved by</td>
                <td style="border:none !important; text-align:right; font-size:12px;">Client Signature</td>
            </tr>
        </table>

        <p class="fixed-bottom" style="text-align: center; font-size: 12px;">This is a Computer Generated Invoice</p>
    </div>
</body>

</html>