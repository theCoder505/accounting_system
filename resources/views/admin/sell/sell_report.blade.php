<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Report</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>

    <style>
        .site_detail {
            text-align: center;
        }

        table {
            margin-top: 10px;
        }

        td {
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
                Contact Number - {{ $site_info->phone ?? '' }} <br>
                Email -{{ $site_info->email ?? '' }} <br>
                Address - {{ $site_info->address ?? '' }}
            </p>
        </div>

        <div class="col-md-12">
            <div class="row">
                @if ($from_date)
                    <div class="col-md-6">
                        <h3>From Date - {{ $from_date }}</h3>
                    </div>
                @endif

                @if ($to_date)
                    <div class="col-md-6">To Date - {{ $to_date }}</div>
                @endif
            </div>
        </div>

        <table id="" class="">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Number</th>
                    <th>Total (TK)</th>
                    <th>Discount (%)</th>
                    <th>Discount (TK)</th>
                    <th>Pay (TK)</th>
                    <th>Due (TK)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                    $total = 0;
                    $discount = 0;
                    $discount_percentage = 0;
                    $pay = 0;
                    $total = 0;
                    $due = 0;
                @endphp
                @foreach ($datas as $item)
                    <?php
                    $total = $total + $item->total;
                    $discount_percentage = $discount_percentage + $item->discount_percentage;
                    $discount = $discount + $item->total_discount_amount;
                    $pay = $pay + $item->pay;
                    $due = $due + $item->due;
                    ?>

                    <tr>
                        <td>{{ $i }}</td>

                        <td>{{ $item->date ?? '' }}</td>
                        <td>{{ $item->company->name ?? '' }}</td>
                        <td>{{ $item->company->phone ?? '' }}</td>
                        <td>{{ $item->total ?? 0 }}</td>
                        <td>{{ $item->discount_percentage ?? 0 }}</td>
                        <td>{{ $item->total_discount_amount ?? 0 }}</td>
                        <td>{{ $item->pay ?? 0 }}</td>
                        <td>{{ $item->due ?? 0 }}</td>


                    </tr>
                    @php $i++; @endphp
                @endforeach
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <strong>
                            Total
                        </strong>
                    </td>
                    <td>
                        <strong>
                            @php echo $total ?? 0 ;  @endphp
                        </strong>
                    </td>
                    <td>
                        <strong>
                            @php echo $discount_percentage ?? 0 ;  @endphp
                        </strong> 
                    </td>

                    <td>
                        <strong>
                            @php echo $discount ?? 0 ;  @endphp
                        </strong>
                    </td>
                    <td>
                        <strong>
                            @php echo $pay ?? 0 ;  @endphp
                        </strong>
                    </td>
                    <td>
                        <strong>
                            @php echo $due ?? 0 ;  @endphp
                        </strong>
                    </td>
                </tr>

            </tfoot>

        </table>

    </div>


</body>

</html>
