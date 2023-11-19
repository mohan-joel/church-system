<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youth Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/print.css" media="print">
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }
        table{
            width:100%;
            border-collapse:collapse;
        }
        table th,
        table td
        {
            border: 1px solid #ddd;
            padding:1px;
            text-align:left;
        }

        table thead{
            background-color: #f2f2f2;
        }
        img{
            border: radius 50px;
        }

        .company-logo {
            width: 100px; /* Set the width of the logo */
            float:left;
        }

        h3 {
            font-size: 1.5em;
            text-align:center;
        }
    </style>
</head>
<body>
    <div class="container">
    <img src="{{ asset('storage/images/users/'.Auth::user()->church_logo )}}" style="height: 100px; width: 100px; margin-top: 25px;" class="company-logo" alt="logo" />
    </div>
   <div class="container" style="margin-top:30px">
   <div class="container">
   <h1 style="text-align:center;">{{ Auth::user()->church_name }}</h1>
   <p style="text-align:center;" class="address"><b>{{ Auth::user()->church_address }}</b></p>
   </div>
   <h5 style="margin-top:80px;">List of all incomes</h5>
    <table>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Date</th>
                <th>Income Title</th>
                <th>Amount(Rs)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($incomes as $income)
            <tr>
                <td>{{ $b++ }}</td>
                <td>{{ $income->date }}</td>
                <td>{{ $income->title }}</td>
                <td>{{ $income->amount }}</td>
            </tr>
            @endforeach
           <thead>
            <tr>
                <th></th>
                <th colspan="2">Total Income</th>
                <th>{{ $total }}</th>
            </tr>
           </thead>
        </tbody>
    </table>
   </div>

    <div class="container text-center">
        <a href="{{ route('showIncomes') }}" id="btn_go_back" class="btn btn-info">Go Back</a>
        <input type="button" id="print_btn" value="Print"  class="btn btn-secondary"  onclick="window.print()">
    </div>
</body>
</html>