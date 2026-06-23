<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="utf-8">
    <style>
        body{
            font-family: DejaVu Sans;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th,td{
            border:1px solid #000;
            padding:8px;
            text-align:center;
        }
    </style>
</head>
<body>

<h2>تقرير العملاء</h2>

<table>
    <thead>
        <tr>
            <th>الاسم</th>
            <th>الهاتف</th>
            <th>رقم الاقامه</th>
            <th>العنوان</th>
            <th>عدد العقود</th>
            <th>الإجمالي</th>
            <th>الحالة</th>
        </tr>
    </thead>

    <tbody>
        @foreach($clients as $client)
        <tr>
            <td>{{ $client->name }}</td>
            <td>{{ $client->phone }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ $client->address }}</td>
            <td>{{ $client->contracts->count() }}</td>
            <td>{{ number_format($client->contracts->sum('total_amount')) }}</td>
            <td>{{ $client->status == 'active' ? 'نشط' : 'غير نشط' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
window.onload = function () {
    window.print();

    // اختياري: إغلاق الصفحة بعد الطباعة
    window.onafterprint = function () {
        window.close();
    };
};
</script>
</body>
</html>