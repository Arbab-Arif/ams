<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daily Attendance Report</title>

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
            <td colspan="8"><h1 style="text-align: center!important;">Daily Attendance Report</h1>
            </td>
        </tr>
        <tr class="heading">
            <td>S.No</td>
            <td>Company</td>
            <td>Department</td>
            <td>Employee</td>
            <td>Time In</td>
            <td>Time Out</td>
            <td>Over Time</td>
            <td>Attendance</td>
        </tr>
{{--        @foreach($data as $key => $dailyAttendanceData)--}}
{{--            <tr class="item">--}}
{{--                <td>{{ $key + 1 }}</td>--}}
{{--                <td>{{ $dailyAttendanceData->company->name }}</td>--}}
{{--                <td>{{ $dailyAttendanceData->department->name }}</td>--}}
{{--                <td>{{ $dailyAttendanceData->name }}</td>--}}
{{--                <td>--}}
{{--                    {{ $dailyAttendanceData->attendance->count() ? $dailyAttendanceData->attendance->first()->time : 'N/A' }}--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                    {{ $dailyAttendanceData->attendance->count() ? $dailyAttendanceData->attendance->last()->time : 'N/A' }}--}}
{{--                </td>--}}
{{--                <td></td>--}}
{{--                <td>{{ $dailyAttendanceData->attendance->count() ? 'P' : 'A' }}</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
    </table>
</div>
</body>
</html>
