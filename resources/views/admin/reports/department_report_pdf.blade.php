<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Department Report</title>

    <style>
        .invoice-box {
            max-width: 1000px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }


        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="4"><h1 style="text-align: center!important;">Department Report</h1>
            </td>
        </tr>
        <tr class="heading">
            <td>S.No</td>
            <td>Date</td>
            <td>Department</td>
            <td>No Of Employee</td>
        </tr>
        @foreach($data as $key => $departmentData)
            <tr class="item">
                <td>{{ $key + 1 }}</td>
                <td>{{ $departmentData->created_at }}</td>
                <td>{{ $departmentData->name }}</td>
                <td>{{ $departmentData->users->count() }}</td>
            </tr>
        @endforeach
    </table>
</div>
</body>
</html>
