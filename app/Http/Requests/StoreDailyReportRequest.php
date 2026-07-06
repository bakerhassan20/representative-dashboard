<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDailyReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_number' => ['required', 'string', 'exists:clients,id_number'],
            'phone' => ['required', 'string', 'max:20'],
            'report_date' => ['required', 'date'],
            'earned_amount' => ['required', 'numeric', 'min:0'],
            'fees' => ['nullable', 'numeric', 'min:0'],
            'tips' => ['nullable', 'numeric', 'min:0'],
            'delivery_hours' => ['required', 'numeric', 'min:0'],
            'vehicle_type' => ['required', 'string', 'in:سيارة,دباب'],
            'payment_image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'id_number.required' => 'رقم معرف المندوب مطلوب.',
            'id_number.exists' => 'رقم المعرف المدخل غير مسجل في النظام.',
            'phone.required' => 'رقم الجوال مطلوب.',
            'phone.max' => 'رقم الجوال يجب ألا يتجاوز 20 حرفاً.',
            'report_date.required' => 'تاريخ التقرير مطلوب.',
            'report_date.date' => 'تاريخ التقرير يجب أن يكون تاريخاً صالحاً.',
            'earned_amount.required' => 'إجمالي المبالغ المكتسبة مطلوب.',
            'earned_amount.numeric' => 'المبالغ المكتسبة يجب أن تكون قيمة رقمية.',
            'earned_amount.min' => 'المبالغ المكتسبة لا يمكن أن تكون أقل من 0.',
            'fees.numeric' => 'الرسوم يجب أن تكون قيمة رقمية.',
            'fees.min' => 'الرسوم لا يمكن أن تكون أقل من 0.',
            'tips.numeric' => 'الإكرامية يجب أن تكون قيمة رقمية.',
            'tips.min' => 'الإكرامية لا يمكن أن تكون أقل من 0.',
            'delivery_hours.required' => 'ساعات التوصيل مطلوبة.',
            'delivery_hours.numeric' => 'ساعات التوصيل يجب أن تكون قيمة رقمية.',
            'delivery_hours.min' => 'ساعات التوصيل لا يمكن أن تكون أقل من 0.',
            'vehicle_type.required' => 'نوع المركبة مطلوب.',
            'vehicle_type.in' => 'نوع المركبة المختار غير صالح (يجب أن يكون سيارة أو دباب).',
            'payment_image.required' => 'كشف الدفعات (الصورة) مطلوب.',
            'payment_image.image' => 'الملف المرفوع يجب أن يكون صورة.',
            'payment_image.mimes' => 'يجب أن تكون الصورة بصيغة: jpeg, png, jpg.',
            'payment_image.max' => 'حجم الصورة يجب ألا يتجاوز 5 ميجابايت.',
        ];
    }
}