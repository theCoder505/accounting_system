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
/*             border-top: none;
            border-bottom: none; */
        }
        .border-none {
            border: none;
        }
        .border-none-tr,
        .border-none-tr td {
            border: none;
        }
        table#heading_table, table#heading_table td, table#heading_table tr {
            border: none !important;
        }
        .heading {
            width: 400px;
            margin: 0 auto;
            background: aliceblue;
            padding: 6px 0;
        }
        .heading-small{
            width:150px;
        }
        table#heading_table {
            margin-top: -20px;
        }
        .text-center{
            text-align:center;
        }
        .txt-small{
            font-size:10px;
        }
        

        .signatures {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 50px 0;
            margin-top: 200px;
        }
        
        .signatures p {
            font-size: 12px;
        }
        
        table.cst,table.cst th, table.cst tr, table.cst tr, table.cst td{
            height:15px !important;
            font-size:12px;
            border-color: #b1b1b1;
            border-width: thin;
        }
        .fixed-bottom {
            position: fixed;
            bottom: -16px;
            right: 5px;
        }
        
        #sign{
            position: fixed;
            width: 100%;
            bottom:40px;
            left:0;
            margin:0
            padding:0;
        }
        
    </style>
</head>

<body>
    <div>
        <table id="heading_table" class="table goods-table no-border">
            <tr>
                <td colspan="12" style="text-align: center; font-size: 26px;"> <img src="{{ asset($image->logo) }}" style="width: 80px"> </td>
            </tr>
            <tr>
                <td colspan="12" style="text-align: center; font-size: 26px;font-weight:bold;"><p class="heading"> {{ $site_info->site_name }}</p> </td>
            </tr>
            <tr>
                <td colspan="12" style="text-align: center; font-size:14px;">{{ $site_info->address }}</td>
            </tr>
            <tr>
                <td colspan="12" style="text-align: center; font-size:14px">{{ $site_info->phone }}

                    @if($site_info->email)
                    , E-mail: {{ $site_info->email }}
                    @endif

                </td>
            </tr>
            <br>
            <tr style="">
                <td colspan="4">Client Name: {{ $data->company->name ?? '' }}</td>
                <td colspan="3"></td>
                <td colspan="5" style="text-align:right">Date: {{ Carbon\Carbon::parse($data->date)->format('d M Y') }} </td>
            </tr>
            <tr style="">
                <td colspan="4">Delivery Site: {{ $data->delivery_site ?? '' }}</td>
                <td colspan="3"></td>
                <td colspan="5" style="text-align:right">Chalan No: {{ $data->invoice_id ?? '' }}</td>
                
            </tr>
            <tr style="">
                <td colspan="4">Sales Ref: {{ $data->sale_ref ?? '' }}</td>
                <td colspan="3"></td>
                <td colspan="5" style="text-align:right">Project Name: {{ $data->project_name ?? '' }}</td>
   
            </tr>
            <tr style="">
                <td colspan="7"></td>

                <td colspan="5" style="text-align:right">Contact: {{ $data->contact ?? '' }}</td>
            </tr>
        </table>

        <h4 class="heading heading-small" style="text-align: center; font-size: 14px">Delivery Challan</h4>
        <table class="table goods-table cst">
            <thead>
                <tr>
                    <th class="text-center">Sl. No.</th>
                    <th class="txt-smal" style="text-align:left">Prod Code </th>
                    <th colspan="8">Description/Item</th>
                    <th class="text-center ">Order Qty</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>

                @php 
                    $i=1; 
                @endphp

                @foreach($products as $item)
                <tr>
                    <td class="text-center">   {{ $i++ }}</td>
                    <td class="txt-small">  {{ $item->product->code ?? '' }} </td>
                    <td colspan="8" >  {{ $item->product->name ?? '' }}  </td>
                    <td class="text-center"> {{ $item->order_qty ?? '0' }}    </td>
                    <td>{{ $item->remarks ?? '' }}</td>
                </tr>
                @endforeach
             
               

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="9"></td>
                    <td>Total</td>
                    <td class="text-center"><strong> {{$data->total ?? 0}}  </strong></td>
                    <td></td>
                </tr>


            </tfoot>
        </table>
        <table id="sign" class="table"  style="border:none !important;">
            <tr style="border:none !important">
                <td style="border:none !important; text-align:left; font-size:12px;">Checked by</td>
                <td style="border:none !important; text-align:center; font-size:12px;">Approved by</td>
                <td style="border:none !important; text-align:right; font-size:12px;">Client Signature</td>
            </tr>
        </table>

        <p class="fixed-bottom" style="text-align: center; font-size: 12px;">This is a Computer Generated Chalan</p>
    </div>
</body>

</html>