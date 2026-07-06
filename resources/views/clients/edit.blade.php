@extends('layouts.app')

@section('title', 'تعديل بيانات العميل')

@section('content')

<div class="page-header">
    <div>
        <h4 class="page-title">تعديل بيانات العميل</h4>
        <p class="page-subtitle">{{ $client->name }}</p>
    </div>
    <a href="{{ route('clients.index') }}" class="btn-modern-secondary">
        <i class="bi bi-arrow-right"></i> العودة للقائمة
    </a>
</div>
@can('edit clients')

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 p-4">
            <h5 class="form-section-title mb-4">
                <i class="bi bi-pencil-square"></i> تعديل البيانات
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

            <form method="POST" action="{{ route('clients.update', $client->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group-modern mb-4">
                    <label class="form-label-modern">الاسم الكامل <span class="text-danger">*</span></label>
                    <div class="input-icon-wrapper">
                        <i class="bi bi-person input-icon"></i>
                        <input type="text" name="name" value="{{ old('name', $client->name) }}"
                               class="form-control form-control-modern @error('name') is-invalid @enderror" required>
                    </div>
                </div>

                
                <div class="form-group-modern mb-4">
                    <label class="form-label-modern">رقم المعرف </label>
                    <div class="input-icon-wrapper">
                        <i class="bi bi-123 input-icon"></i>
                        <input type="number" name="id_number" value="{{ old('id_number', $client->id_number) }}"
                               class="form-control form-control-modern @error('id_number') is-invalid @enderror"
                               placeholder="رقم المعرف">
                    </div>
                </div>

                {{-- City --}}
                 <div class="form-group-modern mb-4">
                    <label class="form-label-modern">المدينة <span class="text-danger">*</span></label>
                    <div class="input-icon-wrapper">
                        <i class="bi bi-geo-alt input-icon"></i>
                        <select name="city_id" class="form-control form-control-modern">
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id', $client->city_id) == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group-modern mb-5">
                    <label class="form-label-modern">الحالة</label>
                    <select name="status" class="form-control form-control-modern">
                        <option value="active" @selected($client->status == 'active')>✅ نشط</option>
                        <option value="inactive" @selected($client->status == 'inactive')>❌ غير نشط</option>
                    </select>
                </div>

                <div class="d-flex gap-3">
                    <button type="submit" class="btn-modern-primary flex-grow-1">
                        <i class="bi bi-check-lg"></i> حفظ التعديلات
                    </button>
                    <a href="{{ route('clients.index') }}" class="btn-modern-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan
@endsection