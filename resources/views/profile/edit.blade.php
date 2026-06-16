
@extends('layouts.app')

@section('title', 'الملف الشخصي')

@section('content')

<div class="page-header">
    <div>
        <h4 class="page-title">الملف الشخصي</h4>
        <p class="page-subtitle">تعديل بيانات الحساب</p>
    </div>
</div>

@if (session('status') === 'profile-updated')
    <div class="alert alert-success">
        تم تحديث البيانات بنجاح
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card border-0 p-4">

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf

        <div class="row">

            <div class="col-md-6 mb-4">
                <label class="form-label fw-bold">
                    الاسم
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="form-control"
                    required
                >
            </div>

            <div class="col-md-6 mb-4">
                <label class="form-label fw-bold">
                    البريد الإلكتروني
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    class="form-control"
                    required
                >
            </div>

        </div>

        <div class="d-flex gap-2">

            <button
                type="submit"
                class="btn btn-primary"
            >
                <i class="bi bi-check-lg"></i>
                حفظ التعديلات
            </button>

        </div>

    </form>

</div>

<div class="card border-0 p-4 mt-4">

    <h5 class="mb-3 text-danger">
        تغيير كلمة المرور
    </h5>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">
                كلمة المرور الحالية
            </label>

            <input
                type="password"
                name="current_password"
                class="form-control"
            >
        </div>

        <div class="mb-3">
            <label class="form-label">
                كلمة المرور الجديدة
            </label>

            <input
                type="password"
                name="password"
                class="form-control"
            >
        </div>

        <div class="mb-3">
            <label class="form-label">
                تأكيد كلمة المرور الجديدة
            </label>

            <input
                type="password"
                name="password_confirmation"
                class="form-control"
            >
        </div>

        <button
            type="submit"
            class="btn btn-warning"
        >
            تحديث كلمة المرور
        </button>

    </form>

</div>

<div class="card border-0 p-4 mt-4">

    <h5 class="text-danger mb-3">
        حذف الحساب
    </h5>

    <form
        method="POST"
        action="{{ route('profile.destroy') }}"
        onsubmit="return confirm('هل أنت متأكد من حذف الحساب نهائياً؟')"
    >
        @csrf
        @method('DELETE')

        <div class="mb-3">
            <label class="form-label">
                كلمة المرور
            </label>

            <input
                type="password"
                name="password"
                class="form-control"
                required
            >
        </div>

        <button
            type="submit"
            class="btn btn-danger"
        >
            حذف الحساب
        </button>

    </form>

</div>

@endsection