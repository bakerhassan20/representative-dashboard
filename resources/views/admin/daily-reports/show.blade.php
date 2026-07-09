@extends('layouts.app')

@section('title', 'تفاصيل التقرير اليومي')

@section('content')

<div class="mb-3">
    <a href="{{ route('admin.daily-reports.index') }}" class="btn btn-light border shadow-sm">
        <i class="bi bi-arrow-right me-1"></i> العودة للقائمة
    </a>
</div>

<div class="row g-4">
    <!-- Driver Info -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h6 class="fw-bold text-primary mb-0"><i class="bi bi-person-badge me-2"></i> بيانات المندوب</h6>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">الاسم:</span>
                        <span class="fw-bold">{{ $report->client->name ?? 'غير محدد' }}</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">رقم الهوية:</span>
                        <span class="fw-bold">{{ $report->client->id_number ?? 'غير محدد' }}</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">المدينة:</span>
                        <span class="fw-bold">{{ $report->city->name ?? 'غير محدد' }}</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">رقم الجوال:</span>
                        <span class="fw-bold">{{ $report->phone }}</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">حالة المندوب:</span>
                        <span class="badge bg-{{ ($report->client->status ?? '') == 'active' ? 'success' : 'secondary' }}">
                            {{ ($report->client->status ?? '') == 'active' ? 'نشط' : 'غير نشط' }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Report Info -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h6 class="fw-bold text-primary mb-0"><i class="bi bi-journal-check me-2"></i> تفاصيل التقرير</h6>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">تاريخ التقرير:</span>
                        <span class="fw-bold">{{ $report->report_date->format('Y-m-d') }}</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">تاريخ الرفع:</span>
                        <span class="fw-bold">{{ $report->created_at->format('Y-m-d H:i') }}</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">نوع المركبة:</span>
                        <span class="fw-bold">{{ $report->vehicle_type }}</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">الطلبات المكتملة:</span>
                        <span class="fw-bold">{{ $report->completed_orders_count }} طلب</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">طلبات الرفض:</span>
                        <span class="fw-bold">{{ $report->rejected_orders_count }} طلب</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">ساعات التوصيل:</span>
                        <span class="fw-bold">{{ $report->delivery_hours }} ساعة</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">حالة التقرير:</span>
                        @if($report->status == 'approved')
                            <span class="badge bg-success">معتمد</span>
                        @elseif($report->status == 'rejected')
                            <span class="badge bg-danger">مرفوض</span>
                        @else
                            <span class="badge bg-warning text-dark">انتظار</span>
                        @endif
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">قابلية إعادة الإرسال:</span>
                        @if($report->allow_resubmit)
                            <span class="badge bg-success">مسموح</span>
                        @else
                            <span class="badge bg-secondary">غير مسموح</span>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Financials -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h6 class="fw-bold text-primary mb-0"><i class="bi bi-cash-coin me-2"></i> الملخص المالي</h6>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">الأرباح:</span>
                        <span class="fw-bold text-success">{{ number_format($report->earned_amount, 2) }} ر.س</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between">
                        <span class="text-muted">الرسوم (قيمة طلبات الرفض وغيرها):</span>
                        <span class="fw-bold text-danger">- {{ number_format($report->fees, 2) }} ر.س</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between bg-light mt-2 rounded">
                        <span class="text-dark fw-bold">صافي الدخل:</span>
                        <span class="fw-bold fs-5 text-dark">{{ number_format($report->earned_amount - $report->fees, 2) }} ر.س</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Image & Notes -->
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h6 class="fw-bold text-primary mb-0"><i class="bi bi-image me-2"></i> صورة كشف الحساب</h6>
            </div>
            <div class="card-body text-center">
                @if($report->payment_image)
                    <img src="{{ Storage::url($report->payment_image) }}" alt="كشف الحساب" class="img-fluid rounded border p-1" style="max-height: 500px; object-fit: contain;">
                @else
                    <div class="p-5 bg-light rounded text-muted">
                        <i class="bi bi-image-alt fs-1 d-block mb-2"></i>
                        لا توجد صورة مرفقة
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Notes -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h6 class="fw-bold text-primary mb-0"><i class="bi bi-journal-richtext me-2"></i> الملاحظات</h6>
            </div>
            <div class="card-body">
                <p class="mb-0 text-muted">{{ $report->notes ?: 'لا توجد ملاحظات.' }}</p>
            </div>
        </div>

        <!-- Actions -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                <h6 class="fw-bold text-primary mb-0"><i class="bi bi-sliders me-2"></i> الإجراءات</h6>
            </div>
            <div class="card-body">
                <!-- Status Forms -->
                <div class="d-flex gap-2 mb-3">
                    <form action="{{ route('admin.daily-reports.status', $report->id) }}" method="POST" class="flex-grow-1">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="approved">
                        <button class="btn btn-success w-100" {{ $report->status == 'approved' ? 'disabled' : '' }}>
                            <i class="bi bi-check-circle me-1"></i> اعتماد
                        </button>
                    </form>
                    <form action="{{ route('admin.daily-reports.status', $report->id) }}" method="POST" class="flex-grow-1">
                        @csrf @method('PUT')
                        <input type="hidden" name="status" value="rejected">
                        <button class="btn btn-danger w-100" {{ $report->status == 'rejected' ? 'disabled' : '' }}>
                            <i class="bi bi-x-circle me-1"></i> رفض
                        </button>
                    </form>
                </div>

                <!-- Resubmit Form -->
                <form action="{{ route('admin.daily-reports.resubmit', $report->id) }}" method="POST" class="mb-3">
                    @csrf @method('PUT')
                    @if($report->allow_resubmit)
                        <button class="btn btn-secondary w-100 text-start d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-lock me-1"></i> تعطيل التعديل</span>
                        </button>
                    @else
                        <button class="btn btn-outline-primary w-100 text-start d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-unlock me-1"></i> السماح بالتعديل وإعادة الإرسال</span>
                        </button>
                    @endif
                </form>

                @if($report->payment_image)
                    <a href="{{ Storage::url($report->payment_image) }}" download class="btn btn-info w-100 text-white mb-3 text-start d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-download me-1"></i> تحميل صورة الكشف</span>
                    </a>
                @endif

                <form action="{{ route('admin.daily-reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا التقرير نهائياً؟');">
                    @csrf @method('DELETE')
                    <button class="btn btn-outline-danger w-100 text-start d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-trash me-1"></i> حذف التقرير</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
