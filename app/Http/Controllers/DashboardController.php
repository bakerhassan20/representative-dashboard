<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\DailyReport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        
        $totalDrivers = Client::count();
        $activeDrivers = Client::where('status', 'active')->count();
        $inactiveDrivers = Client::where('status', 'inactive')->count();
        
        $reportsToday = DailyReport::whereDate('report_date', $today)->count();
        $missingReportsToday = $activeDrivers - $reportsToday; // Approximation or actual query
        $missingReportsTodayCount = Client::where('status', 'active')->whereDoesntHave('dailyReports', function ($q) use ($today) {
            $q->whereDate('report_date', $today);
        })->count();

        $pendingReports = DailyReport::where('status', 'pending')->count();
        $approvedReports = DailyReport::where('status', 'approved')->count();
        $rejectedReports = DailyReport::where('status', 'rejected')->count();

        $todaysEarnings = DailyReport::whereDate('report_date', $today)->sum('earned_amount');
        $todaysFees = DailyReport::whereDate('report_date', $today)->sum('fees');
        $todaysTips = DailyReport::whereDate('report_date', $today)->sum('tips');
        $todaysNetIncome = $todaysEarnings + $todaysTips - $todaysFees;

        $avgDeliveryHoursToday = DailyReport::whereDate('report_date', $today)->avg('delivery_hours') ?? 0;
        
        $reportsThisWeek = DailyReport::whereBetween('report_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $reportsThisMonth = DailyReport::whereMonth('report_date', Carbon::now()->month)->whereYear('report_date', Carbon::now()->year)->count();

        // Charts Data
        $last30Days = Carbon::today()->subDays(29);
        
        // 1. Daily reports for last 30 days
        // 2. Daily earnings for last 30 days
        $dailyDataLast30Days = DailyReport::select(
            DB::raw('DATE(report_date) as date'),
            DB::raw('COUNT(*) as count'),
            DB::raw('SUM(earned_amount) as earnings')
        )
        ->whereDate('report_date', '>=', $last30Days)
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        $dates30 = [];
        $reports30 = [];
        $earnings30 = [];
        foreach ($dailyDataLast30Days as $data) {
            $dates30[] = $data->date;
            $reports30[] = $data->count;
            $earnings30[] = $data->earnings;
        }

        // 3. Reports grouped by city
        $reportsByCity = DailyReport::select('cities.name', DB::raw('COUNT(*) as count'))
            ->join('cities', 'daily_reports.city_id', '=', 'cities.id')
            ->groupBy('cities.name')
            ->pluck('count', 'name')->toArray();

        // 4. Vehicle type distribution
        $vehicleTypes = DailyReport::select('vehicle_type', DB::raw('COUNT(*) as count'))
            ->groupBy('vehicle_type')
            ->pluck('count', 'vehicle_type')->toArray();

        // 5. Report Status Distribution
        $reportStatus = DailyReport::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')->toArray();

        // 6. Top 10 cities by submitted reports
        $topCities = DailyReport::select('cities.name', DB::raw('COUNT(*) as count'))
            ->join('cities', 'daily_reports.city_id', '=', 'cities.id')
            ->groupBy('cities.name')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        // 7. Top Drivers by earnings
        $topDrivers = DailyReport::select('clients.name', DB::raw('SUM(earned_amount) as total_earnings'))
            ->join('clients', 'daily_reports.client_id', '=', 'clients.id')
            ->groupBy('clients.name')
            ->orderByDesc('total_earnings')
            ->limit(10)
            ->get();

        // 8. Drivers who didn't submit today's report
        $driversWithoutReportToday = Client::where('status', 'active')
            ->whereDoesntHave('dailyReports', function ($q) use ($today) {
                $q->whereDate('report_date', $today);
            })
            ->with('city')
            ->limit(10)
            ->get();

        return view('dashboard.index', compact(
            'totalDrivers', 'activeDrivers', 'inactiveDrivers',
            'reportsToday', 'missingReportsTodayCount', 'pendingReports', 'approvedReports', 'rejectedReports',
            'todaysEarnings', 'todaysFees', 'todaysTips', 'todaysNetIncome',
            'avgDeliveryHoursToday', 'reportsThisWeek', 'reportsThisMonth',
            'dates30', 'reports30', 'earnings30',
            'reportsByCity', 'vehicleTypes', 'reportStatus',
            'topCities', 'topDrivers', 'driversWithoutReportToday'
        ));
    }
}
