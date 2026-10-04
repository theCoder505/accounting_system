<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Book</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <style>
        .site_detail {
            text-align: center;
        }
        table{
            margin-top: 10px;
        }
         td{
            border: 1px solid black;
            padding: 5px;
        }
    </style>


</head>
<body>
  
  <div class="container">
        <div class="site_detail">
            <h2>{{ $site_info->site_name ?? '' }}</h2>
            <p> 
                Contact Number -  {{ $site_info->phone ?? '' }} <br>
                Email -{{ $site_info->email ?? '' }} <br>
                Address - {{ $site_info->address ?? '' }}
            </p>
        </div>

        <div class="col-md-12">
            <div class="row">
                @if($from_date)
                <div class="col-md-6"><h3>From Date - {{ $from_date }}</h3></div>
                @endif

                @if($to_date)
                <div class="col-md-6">To Date - {{ $to_date }}</div>
                @endif

            </div>
        </div>

        <table id="" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Serial</th>
                <th>Name</th>
                <th>Code</th>
                <th>Category</th>
                <th>Brand</th>
                <!-- <th>T. QTY</th> -->
                <th>A. QTY</th>
                <th>T. Sell</th>
            </tr>
            </thead>
            <tbody>
            @php 
                $i=1; 
                $total_qty = 0;
                $qty = 0;
                $total_sell = 0;
            @endphp
            @foreach($products as $item)

            <?php
                if($item->total_qty == 0){
                    $total_qty = $total_qty + $item->qty;
                }else{
                    $total_qty = $total_qty + $item->total_qty;
                }

                $qty = $qty + $item->qty;
                $total_sell = $total_sell + $item->total_sell;
            ?>

            <tr>
                <td>{{$i}}</td>
               

                <td>{{$item->name}}</td>
                <td>{{$item->qty ?? 0}}</td>
                <td>{{$item->total_sell ?? 0}}</td>

           
            </tr>
            @php $i++; @endphp
            @endforeach

            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                   
                    <!-- <td>
                        <strong>
                            @php echo $total_qty ?? 0 ;  @endphp /-
                        </strong>
                    </td> -->
                  
                    <td>
                        <strong>
                            @php echo $qty ?? 0 ;  @endphp
                        </strong>
                    </td>
                    <td>
                        <strong>
                            @php echo $total_sell ?? 0 ;  @endphp
                        </strong>
                    </td>
               
                </tr>
                
            </tfoot>


        </table>
      
  </div>


</body>
</html>