<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>التقارير اليومية</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            direction: rtl;
            text-align: right;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .text-success { color: green; }
        .text-danger { color: red; }
    </style>
</head>
<body>
    <div class="header">
        <h2>التقارير اليومية للمناديب</h2>
        <p>تاريخ الاستخراج: {{ now()->format('Y-m-d H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>المندوب</th>
                <th>رقم الهوية</th>
                <th>المدينة</th>
                <th>التاريخ</th>
                <th>الأرباح</th>
                <th>الرسوم</th>
                <th>الإكرامية</th>
                <th>الصافي</th>
                <th>الحالة</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
            <tr>
                <td>{{ $report->id }}</td>
                <td>{{ $report->client->name ?? 'غير محدد' }}</td>
                <td>{{ $report->client->id_number ?? 'غير محدد' }}</td>
                <td>{{ $report->city->name ?? 'غير محدد' }}</td>
                <td>{{ $report->report_date->format('Y-m-d') }}</td>
                <td class="text-success">{{ number_format($report->earned_amount, 2) }}</td>
                <td class="text-danger">{{ number_format($report->fees, 2) }}</td>
                <td>{{ number_format($report->tips, 2) }}</td>
                <td>{{ number_format($report->earned_amount + $report->tips - $report->fees, 2) }}</td>
                <td>
                    @if($report->status == 'approved') معتمد
                    @elseif($report->status == 'rejected') مرفوض
                    @else انتظار
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
