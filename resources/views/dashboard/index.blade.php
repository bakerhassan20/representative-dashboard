@extends('layouts.app')

@section('title', 'لوحة التحكم')

@section('content')

    @can('view dashboard')
    <!-- KPI CARDS -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card kpi-card-blue">
                <div class="kpi-card-body">
                    <div class="kpi-card-info">
                        <h6>إجمالي المناديب</h6>
                        <h3>{{ $totalDrivers }}</h3>
                    </div>
                    <div class="kpi-card-icon-wrapper bg-blue-accent">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card kpi-card-green">
                <div class="kpi-card-body">
                    <div class="kpi-card-info">
                        <h6>المناديب النشطين</h6>
                        <h3>{{ $activeDrivers }}</h3>
                    </div>
                    <div class="kpi-card-icon-wrapper bg-green-accent">
                        <i class="bi bi-person-check"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card kpi-card-orange">
                <div class="kpi-card-body">
                    <div class="kpi-card-info">
                        <h6>المناديب غير النشطين</h6>
                        <h3>{{ $inactiveDrivers }}</h3>
                    </div>
                    <div class="kpi-card-icon-wrapper bg-orange-accent">
                        <i class="bi bi-person-x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card kpi-card-purple">
                <div class="kpi-card-body">
                    <div class="kpi-card-info">
                        <h6>تقارير اليوم</h6>
                        <h3>{{ $reportsToday }}</h3>
                    </div>
                    <div class="kpi-card-icon-wrapper bg-purple-accent">
                        <i class="bi bi-journal-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6>تقارير مفقودة اليوم</h6>
                    <h3 class="text-danger">{{ $missingReportsTodayCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6>تقارير قيد الانتظار</h6>
                    <h3 class="text-warning">{{ $pendingReports }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6>تقارير معتمدة</h6>
                    <h3 class="text-success">{{ $approvedReports }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6>تقارير مرفوضة</h6>
                    <h3 class="text-danger">{{ $rejectedReports }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card bg-light border-0 shadow-sm">
                <div class="card-body text-center">
                    <h6 class="text-muted mb-2">أرباح اليوم</h6>
                    <h3 class="text-primary mb-0">{{ number_format($todaysEarnings, 2) }} ر.س</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light border-0 shadow-sm">
                <div class="card-body text-center">
                    <h6 class="text-muted mb-2">رسوم اليوم</h6>
                    <h3 class="text-danger mb-0">{{ number_format($todaysFees, 2) }} ر.س</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light border-0 shadow-sm">
                <div class="card-body text-center">
                    <h6 class="text-muted mb-2">الطلبات المكتملة لليوم</h6>
                    <h3 class="text-success mb-0">{{ $todaysCompletedOrders }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light border-0 shadow-sm">
                <div class="card-body text-center">
                    <h6 class="text-muted mb-2">طلبات الرفض لليوم</h6>
                    <h3 class="text-warning mb-0">{{ $todaysRejectedOrders }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-light border-0 shadow-sm">
                <div class="card-body text-center">
                    <h6 class="text-muted mb-2">صافي دخل اليوم</h6>
                    <h3 class="text-dark fw-bold mb-0">{{ number_format($todaysNetIncome, 2) }} ر.س</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h6>متوسط ساعات التوصيل (اليوم)</h6>
                    <h3>{{ number_format($avgDeliveryHoursToday, 1) }} ساعة</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h6>تقارير هذا الأسبوع</h6>
                    <h3>{{ $reportsThisWeek }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <h6>تقارير هذا الشهر</h6>
                    <h3>{{ $reportsThisMonth }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- CHARTS ROW 1 -->
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card p-4 h-100 border-0 shadow-sm">
                <h5 class="mb-4"><i class="bi bi-graph-up text-primary me-2"></i> التقارير والأرباح (آخر 30 يوم)</h5>
                <div id="reportsEarningsChart"></div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-4 h-100 border-0 shadow-sm">
                <h5 class="mb-4"><i class="bi bi-pie-chart text-success me-2"></i> حالة التقارير</h5>
                <div id="statusChart"></div>
            </div>
        </div>
    </div>

    <!-- CHARTS ROW 2 -->
    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card p-4 h-100 border-0 shadow-sm">
                <h5 class="mb-4"><i class="bi bi-geo-alt text-danger me-2"></i> التقارير حسب المدينة</h5>
                <div id="cityChart"></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card p-4 h-100 border-0 shadow-sm">
                <h5 class="mb-4"><i class="bi bi-truck text-warning me-2"></i> توزيع أنواع المركبات</h5>
                <div id="vehicleChart"></div>
            </div>
        </div>
    </div>

    <!-- DATA TABLES ROW -->
    <div class="row g-4 mb-4">
        <div class="col-lg-4">
            <div class="card p-3 h-100 border-0 shadow-sm">
                <h6 class="mb-3 border-bottom pb-2">أعلى المدن تقديماً للتقارير</h6>
                <ul class="list-group list-group-flush">
                    @forelse($topCities as $city)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            {{ $city->name }}
                            <span class="badge bg-primary rounded-pill">{{ $city->count }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted">لا توجد بيانات</li>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-3 h-100 border-0 shadow-sm">
                <h6 class="mb-3 border-bottom pb-2">أعلى المناديب (بالأرباح)</h6>
                <ul class="list-group list-group-flush">
                    @forelse($topDrivers as $driver)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            {{ $driver->name }}
                            <span class="text-success fw-bold">{{ number_format($driver->total_earnings, 2) }} ر.س</span>
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted">لا توجد بيانات</li>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-3 h-100 border-0 shadow-sm">
                <h6 class="mb-3 border-bottom pb-2">مناديب لم يرسلوا تقرير اليوم</h6>
                <ul class="list-group list-group-flush">
                    @forelse($driversWithoutReportToday as $driver)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            {{ $driver->name }}
                            <span class="badge bg-danger rounded-pill">{{ $driver->city->name ?? 'غير محدد' }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted">الجميع أرسل تقاريره</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
    @endcan

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // 1 & 2: Reports and Earnings Chart
        var options1 = {
            series: [{
                name: 'عدد التقارير',
                type: 'column',
                data: {!! json_encode($reports30) !!}
            }, {
                name: 'الأرباح (ر.س)',
                type: 'line',
                data: {!! json_encode($earnings30) !!}
            }],
            chart: {
                height: 350,
                type: 'line',
                toolbar: { show: false }
            },
            stroke: {
                width: [0, 4]
            },
            xaxis: {
                categories: {!! json_encode($dates30) !!}
            },
            yaxis: [{
                title: { text: 'عدد التقارير' }
            }, {
                opposite: true,
                title: { text: 'الأرباح' }
            }]
        };
        new ApexCharts(document.querySelector("#reportsEarningsChart"), options1).render();

        // 3: Report Status Chart
        var statusKeys = {!! json_encode(array_keys($reportStatus)) !!};
        var statusVals = {!! json_encode(array_values($reportStatus)) !!};
        var options2 = {
            series: statusVals,
            labels: statusKeys.map(k => k == 'approved' ? 'معتمد' : (k == 'pending' ? 'انتظار' : 'مرفوض')),
            chart: { type: 'donut', height: 300 },
            colors: ['#10b981', '#f59e0b', '#ef4444']
        };
        new ApexCharts(document.querySelector("#statusChart"), options2).render();

        // 4: Reports by City Chart
        var cityKeys = {!! json_encode(array_keys($reportsByCity)) !!};
        var cityVals = {!! json_encode(array_values($reportsByCity)) !!};
        var options3 = {
            series: [{ data: cityVals }],
            chart: { type: 'bar', height: 300 },
            plotOptions: { bar: { horizontal: true } },
            xaxis: { categories: cityKeys }
        };
        new ApexCharts(document.querySelector("#cityChart"), options3).render();

        // 5: Vehicle Type Chart
        var vehicleKeys = {!! json_encode(array_keys($vehicleTypes)) !!};
        var vehicleVals = {!! json_encode(array_values($vehicleTypes)) !!};
        var options4 = {
            series: vehicleVals,
            labels: vehicleKeys,
            chart: { type: 'pie', height: 300 }
        };
        new ApexCharts(document.querySelector("#vehicleChart"), options4).render();
    });
</script>
@endpush