<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Client::with('contracts')->get()->map(function ($client) {
            return [
                'name' => $client->name,
                'phone' => $client->phone,
                'id_number' => $client->email,
                'address' => $client->address,
                'contracts_count' => $client->contracts->count(),
                'total_amount' => $client->contracts->sum('total_amount'),
                'status' => $client->status == 'active' ? 'نشط' : 'غير نشط',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'الاسم',
            'الهاتف',
            'رقم الإقامة',
            'العنوان',
            'عدد العقود',
            'إجمالي العقود',
            'الحالة',
        ];
    }
}