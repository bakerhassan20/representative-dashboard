<?php

namespace App\Exports;

use App\Models\DailyReport;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DailyReportExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query;
    }

    public function headings(): array
    {
        return [
            'المعرف',
            'اسم المندوب',
            'رقم الهوية/المعرف',
            'المدينة',
            'رقم الجوال',
            'تاريخ التقرير',
            'نوع المركبة',
            'ساعات التوصيل',
            'الأرباح',
            'الرسوم',
            'الطلبات المكتملة',
            'طلبات الرفض',
            'صافي الدخل',
            'الحالة',
            'تاريخ الإنشاء',
        ];
    }

    public function map($report): array
    {
        $netIncome = $report->earned_amount - $report->fees;
        return [
            $report->id,
            $report->client->name ?? 'غير محدد',
            $report->client->id_number ?? 'غير محدد',
            $report->city->name ?? 'غير محدد',
            $report->phone,
            $report->report_date->format('Y-m-d'),
            $report->vehicle_type,
            $report->delivery_hours,
            $report->earned_amount,
            $report->fees,
            $report->completed_orders_count,
            $report->rejected_orders_count,
            $netIncome,
            $report->status == 'approved' ? 'معتمد' : ($report->status == 'pending' ? 'قيد الانتظار' : 'مرفوض'),
            $report->created_at->format('Y-m-d H:i'),
        ];
    }
}
