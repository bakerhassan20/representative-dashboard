@extends('layouts.app')

@section('title', 'مناديب لم يرسلوا تقرير اليوم')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="fs-4 fw-bold mb-1">
                <i class="bi bi-person-x-fill text-danger me-2"></i>
                مناديب لم يرسلوا تقرير اليوم
            </h1>
            <small class="text-muted">{{ \Carbon\Carbon::today()->translatedFormat('l، d F Y') }}</small>
        </div>
        <a href="{{ route('admin.daily-reports.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-right me-1"></i> التقارير اليومية
        </a>
    </div>

    {{-- Filters --}}
    <form method="GET" action="{{ route('admin.daily-reports.clients-without-report') }}" class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label fw-semibold">البحث بالاسم أو رقم الهوية</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="ابحث..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">المدينة</label>
                    <select name="city_id" class="form-select">
                        <option value="">كل المدن</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-funnel-fill me-1"></i> تصفية
                    </button>
                    <a href="{{ route('admin.daily-reports.clients-without-report') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </form>

    {{-- Results --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-transparent border-bottom d-flex align-items-center justify-content-between py-3">
            <span class="fw-semibold">
                إجمالي النتائج:
                <span class="badge bg-danger ms-1">{{ $clients->total() }}</span>
            </span>
        </div>
        <div class="card-body p-0">
            @if($clients->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                    <p class="mt-3 fs-5 fw-semibold text-success">رائع! جميع المناديب النشطين أرسلوا تقاريرهم اليوم.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>رقم الهوية</th>
                                <th>المدينة</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $index => $client)
                            <tr>
                                <td class="text-muted">{{ $clients->firstItem() + $index }}</td>
                                <td class="fw-semibold">{{ $client->name }}</td>
                                <td>{{ $client->id_number ?? '—' }}</td>
                                <td>{{ $client->city->name ?? '—' }}</td>
                                <td>
                                    <span class="badge bg-warning text-dark">لم يُرسل</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($clients->hasPages())
                <div class="card-footer bg-transparent border-top py-3">
                    {{ $clients->links() }}
                </div>
                @endif
            @endif
        </div>
    </div>

</div>
@endsection
