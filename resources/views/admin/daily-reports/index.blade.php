@extends('layouts.app')

@section('title', 'إدارة التقارير اليومية')

@section('content')

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-bold"><i class="bi bi-journal-text me-2"></i> التقارير اليومية</h5>
        </div>

        <!-- Filters Form -->
        <form action="{{ route('admin.daily-reports.index') }}" method="GET" class="mb-4">
            <div class="row g-3">
                <div class="col-md-2">
                    <label class="form-label">من تاريخ</label>
                    <input type="date" name="date_from" class="form-control form-control-sm" value="{{ request('date_from') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">إلى تاريخ</label>
                    <input type="date" name="date_to" class="form-control form-control-sm" value="{{ request('date_to') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">المدينة</label>
                    <select name="city_id" class="form-select form-select-sm">
                        <option value="">الكل</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">نوع المركبة</label>
                    <select name="vehicle_type" class="form-select form-select-sm">
                        <option value="">الكل</option>
                        <option value="سيارة" {{ request('vehicle_type') == 'سيارة' ? 'selected' : '' }}>سيارة</option>
                        <option value="دباب" {{ request('vehicle_type') == 'دباب' ? 'selected' : '' }}>دباب</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">الحالة</label>
                    <select name="status" class="form-select form-select-sm">
                        <option value="">الكل</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>معتمد</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>مرفوض</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">الفترة السريعة</label>
                    <select name="period" class="form-select form-select-sm">
                        <option value="">مخصص</option>
                        <option value="today" {{ request('period') == 'today' ? 'selected' : '' }}>اليوم</option>
                        <option value="yesterday" {{ request('period') == 'yesterday' ? 'selected' : '' }}>أمس</option>
                        <option value="this_week" {{ request('period') == 'this_week' ? 'selected' : '' }}>هذا الأسبوع</option>
                        <option value="this_month" {{ request('period') == 'this_month' ? 'selected' : '' }}>هذا الشهر</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">بحث شامل</label>
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="اسم، هوية، أو جوال..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">الأرباح من/إلى</label>
                    <div class="input-group input-group-sm">
                        <input type="number" name="min_earnings" class="form-control" placeholder="أدنى" value="{{ request('min_earnings') }}">
                        <input type="number" name="max_earnings" class="form-control" placeholder="أقصى" value="{{ request('max_earnings') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">صورة الدفع</label>
                    <select name="has_payment_image" class="form-select form-select-sm">
                        <option value="">الكل</option>
                        <option value="1" {{ request('has_payment_image') == '1' ? 'selected' : '' }}>يوجد صورة</option>
                        <option value="0" {{ request('has_payment_image') == '0' ? 'selected' : '' }}>لا يوجد صورة</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary btn-sm px-4">تصفية</button>
                    <a href="{{ route('admin.daily-reports.index') }}" class="btn btn-light btn-sm">إعادة ضبط</a>
                    
                    <button type="submit" name="export" value="excel" class="btn btn-success btn-sm" title="تصدير Excel"><i class="bi bi-file-earmark-excel"></i></button>
                    <button type="submit" name="export" value="csv" class="btn btn-secondary btn-sm" title="تصدير CSV"><i class="bi bi-file-earmark-spreadsheet"></i></button>
                    <button type="submit" name="export" value="pdf" class="btn btn-danger btn-sm" title="تصدير PDF"><i class="bi bi-file-earmark-pdf"></i></button>
                </div>
            </div>
        </form>

        <!-- Bulk Actions Form -->
        <form action="{{ route('admin.daily-reports.bulk') }}" method="POST" id="bulk-form">
            @csrf
            <div class="d-flex mb-3 gap-2 align-items-center bg-light p-2 rounded">
                <span class="fw-bold me-2">إجراءات جماعية:</span>
                <select name="action" class="form-select form-select-sm w-auto d-inline-block">
                    <option value="">اختر الإجراء...</option>
                    <option value="approve">اعتماد المحدد</option>
                    <option value="reject">رفض المحدد</option>
                    <option value="enable_resubmit">تمكين إعادة الإرسال</option>
                    <option value="disable_resubmit">تعطيل إعادة الإرسال</option>
                    <option value="export_excel">تصدير المحدد (Excel)</option>
                    <option value="export_pdf">تصدير المحدد (PDF)</option>
                    <option value="delete">حذف المحدد</option>
                </select>
                <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('تأكيد الإجراء الجماعي؟')">تطبيق</button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <input class="form-check-input" type="checkbox" id="check-all">
                            </th>
                            <th><a href="?sort=client&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">المندوب</a></th>
                            <th>رقم الهوية</th>
                            <th><a href="?sort=city&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">المدينة</a></th>
                            <th><a href="?sort=report_date&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">التاريخ</a></th>
                            <th>المركبة</th>
                            <th><a href="?sort=earned_amount&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">الأرباح</a></th>
                            <th><a href="?sort=fees&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">الرسوم</a></th>
                            <th><a href="?sort=tips&direction={{ request('direction') == 'asc' ? 'desc' : 'asc' }}">الإكرامية</a></th>
                            <th>صافي</th>
                            <th>صورة</th>
                            <th>الحالة</th>
                            <th>إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                            <tr>
                                <td>
                                    <input class="form-check-input report-checkbox" type="checkbox" name="ids[]" value="{{ $report->id }}">
                                </td>
                                <td>{{ $report->client->name ?? 'غير محدد' }}</td>
                                <td>{{ $report->client->id_number ?? 'N/A' }}</td>
                                <td>{{ $report->city->name ?? 'N/A' }}</td>
                                <td>{{ $report->report_date->format('Y-m-d') }}</td>
                                <td>{{ $report->vehicle_type }}</td>
                                <td class="text-success fw-bold">{{ $report->earned_amount }}</td>
                                <td class="text-danger">{{ $report->fees }}</td>
                                <td class="text-primary">{{ $report->tips }}</td>
                                <td class="fw-bold">{{ $report->earned_amount + $report->tips - $report->fees }}</td>
                                <td>
                                    @if($report->payment_image)
                                        <a href="{{ Storage::url($report->payment_image) }}" target="_blank" class="badge bg-info text-decoration-none">عرض</a>
                                    @else
                                        <span class="badge bg-secondary">لا يوجد</span>
                                    @endif
                                </td>
                                <td>
                                    @if($report->status == 'approved')
                                        <span class="badge bg-success">معتمد</span>
                                    @elseif($report->status == 'rejected')
                                        <span class="badge bg-danger">مرفوض</span>
                                    @else
                                        <span class="badge bg-warning text-dark">انتظار</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.daily-reports.show', $report->id) }}" class="btn btn-outline-primary" title="التفاصيل"><i class="bi bi-eye"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="text-center py-4 text-muted">لا توجد تقارير مطابقة للبحث.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $reports->links() }}
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('check-all').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('.report-checkbox');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    });
</script>
@endpush

@endsection
