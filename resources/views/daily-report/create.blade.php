@extends('layouts.guest')

@section('content')

<div class="container py-4">

            <!-- Logo & Brand Header -->
            <div class="login-logo text-center mb-5">
                <div class="logo-wrapper mb-3 d-flex justify-content-center">
                    @if(isset($settings) && $settings->logo)
                    <img src="{{ asset('uploads/settings/' . $settings->logo) }}" alt="Logo" class="img-fluid rounded  d-block mx-auto" style="max-height: 120px; object-fit: contain;">
                    @else
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-gradient bg-opacity-10 text-primary rounded-circle shadow-sm mx-auto" style="width: 90px; height: 90px;">
                        <i class="bi bi-building fs-1"></i>
                    </div>
                    @endif
                </div>
                <h3 class="fw-bolder text-primary mb-2">إطلالة المشرق</h3>
                <p class="text-secondary fw-medium mb-3 fs-6">الإطلالة المشرق للخدمات اللوجستيه</p>
                
                <div class="d-flex flex-wrap justify-content-center gap-3 text-muted">
                    <div class="d-flex align-items-center bg-white px-3 py-2 rounded-pill shadow-sm border">
                        <i class="bi bi-envelope-at-fill text-primary ms-2 fs-5"></i>
                        <span class="fw-semibold" style="direction: ltr;">qm100300500@gmail.com</span>
                    </div>
                    <div class="d-flex align-items-center bg-white px-3 py-2 rounded-pill shadow-sm border">
                        <i class="bi bi-telephone-fill text-primary ms-2 fs-5"></i>
                        <span class="fw-semibold" style="direction: ltr;">01122002942</span>
                    </div>
                </div>
            </div>

    <div class="row justify-content-center">
        <div class="col-lg-12 col-xl-12">
            <div class="card shadow border-0 overflow-hidden">
                <div class="card-header bg-gradient bg-primary py-3 text-white d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-journal-check me-2"></i> تقرير المندوب اليومي
                    </h5>
                    <span class="badge bg-white text-primary fw-semibold px-3 py-2 rounded-pill">
                        {{ now()->translatedFormat('l, d F Y') }}
                    </span>
                </div>

                <div class="card-body p-4 p-md-5">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 d-flex align-items-center" role="alert">
                            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                            <div>{{ session('success') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->has('id_number') && $errors->first('id_number') === 'حساب المندوب غير مرتبط بمدينة حالياً. يرجى مراجعة الإدارة.')
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4 d-flex align-items-center" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                            <div>{{ $errors->first('id_number') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST"
                          action="{{ route('daily-report.store') }}"
                          enctype="multipart/form-data"
                          class="needs-validation">

                        @csrf

                        <!-- Row 1: Client Identifiers -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">رقم معرف المندوب</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-person-badge text-primary"></i></span>
                                    <input
                                        type="text"
                                        class="form-control bg-light @error('id_number') is-invalid @enderror"
                                        name="id_number"
                                        placeholder="مثال: 12345"
                                        value="{{ old('id_number') }}"
                                        required>
                                    @error('id_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text mt-2 d-none" id="client-info-display">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-success text-white px-2 py-1"><i class="bi bi-person me-1"></i> <span id="client-name"></span></span>
                                        <span class="badge bg-info text-dark px-2 py-1"><i class="bi bi-geo-alt me-1"></i> <span id="client-city"></span></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">رقم الجوال</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-phone text-primary"></i></span>
                                    <input
                                        type="text"
                                        class="form-control bg-light @error('phone') is-invalid @enderror"
                                        name="phone"
                                        placeholder="مثال: 05xxxxxxx"
                                        value="{{ old('phone') }}"
                                        required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Row 2: Date and Vehicle -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">تاريخ التقرير</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-calendar3 text-primary"></i></span>
                                    <input
                                        type="date"
                                        class="form-control bg-light @error('report_date') is-invalid @enderror"
                                        name="report_date"
                                        value="{{ old('report_date', now()->toDateString()) }}"
                                        max="{{ now()->toDateString() }}"
                                        required>
                                    @error('report_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text small text-muted">يُسمح بتقرير واحد فقط لكل يوم (إلا إذا تم تمكين إعادة الإرسال من الإدارة).</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">نوع المركبة</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-truck text-primary"></i></span>
                                    <select class="form-select bg-light @error('vehicle_type') is-invalid @enderror" name="vehicle_type" required>
                                        <option value="">اختر نوع المركبة...</option>
                                        <option value="سيارة" {{ old('vehicle_type') === 'سيارة' ? 'selected' : '' }}>سيارة</option>
                                        <option value="دباب" {{ old('vehicle_type') === 'دباب' ? 'selected' : '' }}>دباب</option>
                                    </select>
                                    @error('vehicle_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Divider -->
                        <hr class="my-4 text-muted opacity-25">

                        <!-- Section: Financials & Hours -->
                        <h6 class="fw-bold mb-3 text-primary"><i class="bi bi-cash-coin me-1"></i> البيانات المالية وساعات العمل</h6>

                        <div class="row g-4 mb-4">
                            <div class="col-md-6 col-lg-3">
                                <label class="form-label fw-semibold text-secondary">المبالغ المكتسبة</label>
                                <div class="input-group">
                                    <input
                                        type="number"
                                        step="0.01"
                                        class="form-control bg-light @error('earned_amount') is-invalid @enderror"
                                        name="earned_amount"
                                        placeholder="0.00"
                                        value="{{ old('earned_amount') }}"
                                        required>
                                    <span class="input-group-text bg-light border-start-0">ر.س</span>
                                    @error('earned_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label class="form-label fw-semibold text-secondary">عدد الطلبات المكتملة</label>
                                <div class="input-group">
                                    <input
                                        type="number"
                                        step="1"
                                        class="form-control bg-light @error('completed_orders_count') is-invalid @enderror"
                                        name="completed_orders_count"
                                        placeholder="0"
                                        value="{{ old('completed_orders_count', '0') }}"
                                        required>
                                    <span class="input-group-text bg-light border-start-0">طلب</span>
                                    @error('completed_orders_count')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label class="form-label fw-semibold text-secondary">عدد طلبات الرفض</label>
                                <div class="input-group">
                                    <input
                                        type="number"
                                        step="1"
                                        class="form-control bg-light @error('rejected_orders_count') is-invalid @enderror"
                                        name="rejected_orders_count"
                                        placeholder="0"
                                        value="{{ old('rejected_orders_count', '0') }}"
                                        required>
                                    <span class="input-group-text bg-light border-start-0">طلب</span>
                                    @error('rejected_orders_count')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label class="form-label fw-semibold text-secondary">ساعات العمل</label>
                                <div class="input-group">
                                    <input
                                        type="number"
                                        step="0.01"
                                        class="form-control bg-light @error('delivery_hours') is-invalid @enderror"
                                        name="delivery_hours"
                                        placeholder="0.0"
                                        value="{{ old('delivery_hours') }}"
                                        required>
                                    <span class="input-group-text bg-light border-start-0"><i class="bi bi-clock"></i></span>
                                    @error('delivery_hours')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Divider -->
                        <hr class="my-4 text-muted opacity-25">

                        <!-- Section: Upload & Notes -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-secondary">كشف الدفعات (صورة الكشف)</label>
                            <div class="border border-2 border-dashed rounded-3 p-4 text-center bg-light position-relative hover-dragable @error('payment_image') border-danger @enderror" id="dropzone">
                                <input
                                    type="file"
                                    class="form-control position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer @error('payment_image') is-invalid @enderror"
                                    name="payment_image"
                                    id="payment_image"
                                    accept="image/*"
                                    required>
                                <div class="py-2" id="upload-prompt">
                                    <i class="bi bi-cloud-arrow-up text-primary fs-1"></i>
                                    <p class="mb-1 mt-2 fw-semibold">اسحب وأسقط صورة الكشف هنا أو انقر للاختيار</p>
                                    <p class="text-secondary small mb-0">تنسيق الصور المدعوم: JPEG, PNG, JPG (الحد الأقصى 5 ميجابايت)</p>
                                </div>
                                <div class="d-none py-2" id="upload-preview">
                                    <div class="position-relative d-inline-block">
                                        <img src="" class="img-thumbnail" style="max-height: 150px;" id="preview-img">
                                        <button type="button" class="btn btn-sm btn-danger rounded-circle position-absolute top-0 start-0 translate-middle" id="remove-preview-btn">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </div>
                                    <p class="mb-0 mt-2 text-primary fw-semibold small" id="preview-filename"></p>
                                </div>
                            </div>
                            @error('payment_image')
                                <div class="text-danger small mt-2 d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-secondary">ملاحظات إضافية</label>
                            <textarea
                                class="form-control bg-light @error('notes') is-invalid @enderror"
                                rows="3"
                                name="notes"
                                placeholder="أضف أي ملاحظات أو توضيحات أخرى هنا..."
                                >{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold shadow-sm hover-grow">
                            <i class="bi bi-send-fill me-2"></i> إرسال التقرير اليومي
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('payment_image');
        const uploadPrompt = document.getElementById('upload-prompt');
        const uploadPreview = document.getElementById('upload-preview');
        const previewImg = document.getElementById('preview-img');
        const previewFilename = document.getElementById('preview-filename');
        const removePreviewBtn = document.getElementById('remove-preview-btn');
        const dropzone = document.getElementById('dropzone');

        const idNumberInput = document.querySelector('input[name="id_number"]');
        const clientInfoDisplay = document.getElementById('client-info-display');
        const clientNameSpan = document.getElementById('client-name');
        const clientCitySpan = document.getElementById('client-city');

        let timeoutId;
        idNumberInput.addEventListener('input', function() {
            clearTimeout(timeoutId);
            const val = this.value.trim();
            if (val.length >= 2) {
                timeoutId = setTimeout(() => {
                    fetch(`{{ route('daily-report.client-info') }}?id_number=${val}`)
                        .then(res => res.json())
                        .then(data => {
                            if(data.success) {
                                clientNameSpan.textContent = data.name;
                                clientCitySpan.textContent = data.city;
                                clientInfoDisplay.classList.remove('d-none');
                            } else {
                                clientInfoDisplay.classList.add('d-none');
                            }
                        }).catch(() => {
                            clientInfoDisplay.classList.add('d-none');
                        });
                }, 400);
            } else {
                clientInfoDisplay.classList.add('d-none');
            }
        });

        if(idNumberInput.value.trim().length > 0) {
            idNumberInput.dispatchEvent(new Event('input'));
        }

        // Handling File Upload Preview
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImg.src = event.target.result;
                    previewFilename.textContent = file.name;
                    uploadPrompt.classList.add('d-none');
                    uploadPreview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        });

        // Remove Preview Button
        removePreviewBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            fileInput.value = '';
            previewImg.src = '';
            previewFilename.textContent = '';
            uploadPrompt.classList.remove('d-none');
            uploadPreview.classList.add('d-none');
        });

        // Simple drag & drop border highlight styling
        fileInput.addEventListener('dragenter', () => dropzone.classList.add('border-primary', 'bg-white'));
        fileInput.addEventListener('dragleave', () => dropzone.classList.remove('border-primary', 'bg-white'));
        fileInput.addEventListener('drop', () => dropzone.classList.remove('border-primary', 'bg-white'));
    });
</script>

<style>
    .border-dashed {
        border-style: dashed !important;
    }
    .cursor-pointer {
        cursor: pointer;
    }
    .hover-dragable {
        transition: all 0.25s ease;
    }
    .hover-dragable:hover {
        background-color: var(--border-color) !important;
        border-color: var(--primary) !important;
    }
    .hover-grow {
        transition: all 0.25s ease;
    }
    .hover-grow:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(38, 153, 156, 0.25) !important;
    }
    .input-group-text {
        border-color: var(--border-color);
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.25rem rgba(38, 153, 156, 0.15);
    }
    .input-group .form-control:focus + .input-group-text,
    .input-group .form-select:focus + .input-group-text {
        border-color: var(--primary);
    }
</style>
@endpush

@endsection