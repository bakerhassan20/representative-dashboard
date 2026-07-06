@extends('layouts.app')

@section('title', 'إضافة عميل')

@section('content')

<div class="page-header">
    <div>
        <h4 class="page-title">إضافة مدينة جديدة</h4>
        <p class="page-subtitle">أدخل بيانات المدينة الجديدة</p>
    </div>
    <a href="{{ route('cities.index') }}" class="btn-modern-secondary">
        <i class="bi bi-arrow-right"></i> العودة للقائمة
    </a>
</div>
@can('create clients')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 p-4">
            <h5 class="form-section-title mb-4">
                <i class="bi bi-person-plus"></i> بيانات المدينة
            </h5>

            @if($errors->any())
            <div class="alert-modern alert-danger-modern mb-4">
                <i class="bi bi-exclamation-circle-fill"></i>
                <ul class="mb-0 me-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('cities.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group-modern mb-4">
                    <label class="form-label-modern">الاسم  <span class="text-danger">*</span></label>
                    <div class="input-icon-wrapper">
                        <i class="bi bi-person input-icon"></i>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="form-control form-control-modern @error('name') is-invalid @enderror"
                               placeholder="مثال: أحمد محمد" required>
                    </div>
                </div>

                <div class="">
                    <button type="submit" class="btn-modern-primary flex-grow-1">
                        <i class="bi bi-check-lg"></i> حفظ 
                    </button>
                    <a href="{{ route('cities.index') }}" class="btn-modern-secondary">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@endsection