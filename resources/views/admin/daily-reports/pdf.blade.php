<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التقارير اليومية</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Cairo', sans-serif;
            direction: rtl;
            text-align: right;
            font-size: 13px;
            color: #1a1a2e;
            background: #f8f9fa;
            padding: 30px 20px;
        }

        .print-header {
            text-align: center;
            margin-bottom: 28px;
            padding-bottom: 18px;
            border-bottom: 3px solid #2563eb;
        }

        .print-header h1 {
            font-size: 22px;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 6px;
        }

        .print-header p {
            font-size: 12px;
            color: #64748b;
        }

        .btn-print {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 28px;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-family: 'Cairo', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-print:hover { background: #1d4ed8; }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        }

        thead tr {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            color: #fff;
        }

        th {
            padding: 12px 10px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 12px;
            vertical-align: middle;
        }

        tr:last-child td { border-bottom: none; }
        tr:nth-child(even) td { background: #f8faff; }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }
        .badge-approved { background: #dcfce7; color: #166534; }
        .badge-rejected { background: #fee2e2; color: #991b1b; }
        .badge-pending  { background: #fef9c3; color: #92400e; }

        .text-green  { color: #16a34a; font-weight: 600; }
        .text-red    { color: #dc2626; }
        .text-blue   { color: #2563eb; }

        .summary-row {
            margin-top: 18px;
            display: flex;
            justify-content: flex-end;
            gap: 20px;
            font-size: 13px;
            color: #374151;
        }
        .summary-row span { font-weight: 700; }

        /* ======= PRINT STYLES ======= */
        @media print {
            body { background: #fff; padding: 10px; font-size: 11px; }
            .btn-print { display: none !important; }
            table { box-shadow: none; }
            thead tr { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            tr:nth-child(even) td { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>

    <button class="btn-print" onclick="window.print()">🖨 طباعة</button>

    <div class="print-header">
        <h1>التقارير اليومية للمناديب</h1>
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
                <th>مكتملة</th>
                <th>مرفوضة</th>
                <th>الصافي</th>
                <th>الحالة</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalEarned = 0;
                $totalFees   = 0;
                $totalCompleted = 0;
                $totalRejected = 0;
            @endphp
            @foreach($reports as $i => $report)
            @php
                $totalEarned += $report->earned_amount;
                $totalFees   += $report->fees;
                $totalCompleted += $report->completed_orders_count;
                $totalRejected += $report->rejected_orders_count;
                $net = $report->earned_amount - $report->fees;
            @endphp
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $report->client->name ?? 'غير محدد' }}</td>
                <td>{{ $report->client->id_number ?? 'غير محدد' }}</td>
                <td>{{ $report->city->name ?? 'غير محدد' }}</td>
                <td>{{ $report->report_date->format('Y-m-d') }}</td>
                <td class="text-green">{{ number_format($report->earned_amount, 2) }}</td>
                <td class="text-red">{{ number_format($report->fees, 2) }}</td>
                <td class="text-blue">{{ $report->completed_orders_count }}</td>
                <td class="text-warning">{{ $report->rejected_orders_count }}</td>
                <td><strong>{{ number_format($net, 2) }}</strong></td>
                <td>
                    @if($report->status == 'approved')
                        <span class="badge badge-approved">معتمد</span>
                    @elseif($report->status == 'rejected')
                        <span class="badge badge-rejected">مرفوض</span>
                    @else
                        <span class="badge badge-pending">انتظار</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary-row">
        <div>إجمالي التقارير: <span>{{ $reports->count() }}</span></div>
        <div>إجمالي الأرباح: <span class="text-green">{{ number_format($totalEarned, 2) }}</span></div>
        <div>إجمالي الرسوم: <span class="text-red">{{ number_format($totalFees, 2) }}</span></div>
        <div>إجمالي الطلبات المكتملة: <span class="text-blue">{{ $totalCompleted }}</span></div>
        <div>إجمالي طلبات الرفض: <span class="text-warning">{{ $totalRejected }}</span></div>
        <div>الصافي الكلي: <span>{{ number_format($totalEarned - $totalFees, 2) }}</span></div>
    </div>

</body>
</html>
