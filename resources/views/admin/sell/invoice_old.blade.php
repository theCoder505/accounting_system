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
    </style>
</head>

<body>
    <div>
        <table class="table">
            <tbody>
                <tr>
                    <td colspan="2" rowspan="3">
                        <strong>{{ $site_info->site_name ?? ''}}</strong>
                        <p style="max-width: 190px">{{ $site_info->address ?? ''}}</p>
                        Contact : {{ $site_info->phone ?? ''}} <br>
                        E-Mail : {{ $site_info->email ?? ''}}
                    </td>
                    <td>
                        Invoice No <br>
                        <strong>{{ $data->invoice_id ?? '' }}</strong>
                    </td>
                    <td>
                        Dated <br>
                        <strong>
                            <?php 

                            $now = $data->created_at;
                            echo $now->format('d/m/Y g:i A'); 

                            ?>
                        </strong>
                    </td>
                </tr>
                <tr>
                    <td>
                        Delivery Note <br>
                        <strong>{{ $data->delivery_note ?? '' }}</strong>
                    </td>
                    <td>
                        Mode/Terms of Payment <br>
                        <strong>{{ $data->payment_method ?? '' }}</strong>
                    </td>
                </tr>
                <tr>
                    <td>
                        Supplier’s Ref <br>
                        <strong>{{ $data->supplier_ref ?? '' }}</strong>
                        
                    </td>
                    <td>
                        Other Reference(s) <br>
                        <strong>{{ $data->other_ref ?? '' }}</strong>
                        
                    </td>
                </tr>

                <tr>
                    <td colspan="2" rowspan="4">
                        Buyer <br>
                        <strong>{{ $data->company->name ?? ''}}</strong>
                        <p style="max-width: 190px">{{ $data->company->address ?? ''}}</p>
                        Contact : {{ $data->company->phone ?? ''}} <br>

                    </td>
                    <td>Buyer's Order No <br></td>
                    <td>Dated <br></td>
                </tr>
                <tr>
                    <td>Despatch Document No <br></td>
                    <td>
                        Delivery Note Date <br>
                        <strong>
                            <?php 

                            $now = $data->created_at;
                            echo $now->format('d/m/Y g:i A'); 


                            ?>
                        </strong>
                    </td>
                </tr>
                <tr>
                    <td>Despatched through <br></td>
                    <td>Destination <br></td>
                </tr>
                <tr>
                    <td colspan="2">
                        Terms of Delivery <br>
                        <strong>Delivery From Factory</strong>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table goods-table">
            <thead>
                <tr>
                    <th style="width: 20px">Sr No.</th>
                    <th>Description of Goods </th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th style="width: 20px">per</th>
                    <th style="width: 100px">Amount</th>
                </tr>
            </thead>
            <tbody style="height: 1000px;">

                @php 
                    $i=1; 
                @endphp
                @foreach($products as $item)
                <tr>
                    <td>{{$i++}}</td>
                    <td><strong>{{$item->product->name ?? ''}}</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><strong>{{$item->qty ?? 0}} {{$item->product->unit->name ?? ''}}</strong></td>
                    <td>{{$item->rate ?? 0}} /-</td>
                    <td>{{$item->product->unit->name ?? ''}}</td>
                    <td><strong>{{$item->subtotal ?? 0}} /-</strong></td>
                </tr>
                @endforeach


                <tr>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td><br></td>
                    <td style="text-align: right;">Sub Total</td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td style="text-align: right;"><strong> {{$data->total ?? 0}} /-</strong></td>
                </tr>

                <tr>
                    <td><br></td>
                    <td style="text-align: right;">Discount</td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td style="text-align: right;"><strong> {{$data->discount ?? 0}} /-</strong></td>
                </tr>
                
                <tr>
                    <td><br></td>
                    <td style="text-align: right;">Total</td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td style="text-align: right;"><strong> {{$data->total - $data->discount}} /-</strong></td>
                </tr>
                

                <tr>
                    <td><br></td>
                    <td style="text-align: right;">Pay</td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td style="text-align: right;"><strong> {{$data->pay ?? 0}} /-</strong></td>
                </tr>

                @if($data->due > 0)
                <tr>
                    <td><br></td>
                    <td style="text-align: right;">Due</td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td style="text-align: right;"><strong> {{$data->due ?? 0}} /-</strong></td>
                </tr>
                @endif

                <tr class="border-none-tr">
                    <td colspan="5">
                        Amount Chargeable (in words) <br>
                        <strong>{{$total_text}} only</strong>
                    </td>
                    <td style="text-align: right;">E. & O.E</td>
                </tr>
                <tr class="border-none-tr">
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr class="border-none-tr">
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr class="border-none-tr">
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr class="border-none-tr">
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr class="border-none-tr">
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr class="border-none-tr">
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr class="border-none-tr">
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr class="border-none-tr">
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr style="border-top: none;">
                    <td colspan="2" style="font-size: 9px;border-top: none;">
                        <span style="text-decoration: none;">Declaration</span> <br>
                        We declare that this invoice shows the actual price of <br>
                        the goods described and that all particulars are true <br>
                        and correct.
                    </td>
                    <td colspan="4" style="text-align: right;">
                        <strong>for {{ $site_info->site_name ?? ''}}</strong><br> <br>
                        Authorised Signatory
                    </td>
                </tr>
            </tfoot>
        </table>
        <p style="text-align: center; font-size: 12px;">This is a Computer Generated Invoice</p>
    </div>
</body>

</html>