<?php

namespace App\Http\Controllers;

use App\Models\DailyReport;
use App\Models\City;
use App\Models\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Exports\DailyReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminDailyReportController extends Controller
{
    public function index(Request $request)
    {
        $query = DailyReport::with(['client', 'city']);

        // Filters
        if ($request->filled('date_from')) {
            $query->whereDate('report_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('report_date', '<=', $request->date_to);
        }
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }
        if ($request->filled('client_id')) {
            $query->where('client_id', $request->client_id);
        }
        if ($request->filled('vehicle_type')) {
            $query->where('vehicle_type', $request->vehicle_type);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('min_earnings')) {
            $query->where('earned_amount', '>=', $request->min_earnings);
        }
        if ($request->filled('max_earnings')) {
            $query->where('earned_amount', '<=', $request->max_earnings);
        }
        if ($request->filled('min_hours')) {
            $query->where('delivery_hours', '>=', $request->min_hours);
        }
        if ($request->filled('max_hours')) {
            $query->where('delivery_hours', '<=', $request->max_hours);
        }
        if ($request->filled('has_payment_image')) {
            if ($request->has_payment_image == '1') {
                $query->whereNotNull('payment_image');
            } else {
                $query->whereNull('payment_image');
            }
        }
        if ($request->filled('allow_resubmit')) {
            $query->where('allow_resubmit', $request->allow_resubmit == '1');
        }

        // Quick date filters
        if ($request->filled('period')) {
            switch ($request->period) {
                case 'today':
                    $query->whereDate('report_date', Carbon::today());
                    break;
                case 'yesterday':
                    $query->whereDate('report_date', Carbon::yesterday());
                    break;
                case 'this_week':
                    $query->whereBetween('report_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;
                case 'this_month':
                    $query->whereMonth('report_date', Carbon::now()->month)->whereYear('report_date', Carbon::now()->year);
                    break;
            }
        }

        // Search Keyword
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('client', function ($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%")
                       ->orWhere('id_number', 'like', "%{$search}%");
                })->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sortColumn = $request->input('sort', 'created_at');
        $sortDirection = $request->input('direction', 'desc');

        $allowedSorts = ['report_date', 'earned_amount', 'completed_orders_count', 'rejected_orders_count', 'fees', 'delivery_hours', 'created_at'];
        if (in_array($sortColumn, $allowedSorts)) {
            $query->orderBy($sortColumn, $sortDirection);
        } elseif ($sortColumn === 'client') {
            $query->join('clients', 'daily_reports.client_id', '=', 'clients.id')
                  ->orderBy('clients.name', $sortDirection)
                  ->select('daily_reports.*');
        } elseif ($sortColumn === 'city') {
            $query->join('cities', 'daily_reports.city_id', '=', 'cities.id')
                  ->orderBy('cities.name', $sortDirection)
                  ->select('daily_reports.*');
        }

        if ($request->has('export')) {
            $exportType = $request->export;
            $fileName = 'daily_reports_' . now()->format('Y_m_d_His');
            if ($exportType === 'excel') {
                return Excel::download(new DailyReportExport($query), $fileName . '.xlsx');
            } elseif ($exportType === 'csv') {
                return Excel::download(new DailyReportExport($query), $fileName . '.csv', \Maatwebsite\Excel\Excel::CSV);
            } elseif ($exportType === 'pdf') {
                $reports = $query->get();
                return view('admin.daily-reports.pdf', compact('reports'));
            }
        }

        $reports = $query->paginate(20)->withQueryString();

        $cities = City::all();
        $clients = Client::all();

        return view('admin.daily-reports.index', compact('reports', 'cities', 'clients'));
    }

    public function show($id)
    {
        $report = DailyReport::with(['client', 'city'])->findOrFail($id);
        return view('admin.daily-reports.show', compact('report'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pending,approved,rejected']);
        $report = DailyReport::findOrFail($id);
        $report->update(['status' => $request->status]);
        return back()->with('success', 'تم تحديث حالة التقرير بنجاح.');
    }

    public function toggleResubmit($id)
    {
        $report = DailyReport::findOrFail($id);
        $report->update(['allow_resubmit' => !$report->allow_resubmit]);
        return back()->with('success', 'تم تحديث حالة إعادة الإرسال.');
    }

    public function destroy($id)
    {
        $report = DailyReport::findOrFail($id);
        if ($report->payment_image) {
            Storage::disk('public')->delete($report->payment_image);
        }
        $report->delete();
        return redirect()->route('admin.daily-reports.index')->with('success', 'تم حذف التقرير.');
    }

    public function bulkAction(Request $request)
    {
        $action = $request->action;
        $ids = $request->ids;

        if (!$ids || !is_array($ids) || empty($action)) {
            return back()->with('error', 'يرجى تحديد تقارير وإجراء.');
        }

        switch ($action) {
            case 'approve':
                DailyReport::whereIn('id', $ids)->update(['status' => 'approved']);
                break;
            case 'reject':
                DailyReport::whereIn('id', $ids)->update(['status' => 'rejected']);
                break;
            case 'delete':
                $reports = DailyReport::whereIn('id', $ids)->get();
                foreach ($reports as $report) {
                    if ($report->payment_image) {
                        Storage::disk('public')->delete($report->payment_image);
                    }
                    $report->delete();
                }
                break;
            case 'enable_resubmit':
                DailyReport::whereIn('id', $ids)->update(['allow_resubmit' => true]);
                break;
            case 'disable_resubmit':
                DailyReport::whereIn('id', $ids)->update(['allow_resubmit' => false]);
                break;
            case 'export_excel':
                $query = DailyReport::whereIn('id', $ids);
                return Excel::download(new DailyReportExport($query), 'selected_reports.xlsx');
            case 'export_csv':
                $query = DailyReport::whereIn('id', $ids);
                return Excel::download(new DailyReportExport($query), 'selected_reports.csv', \Maatwebsite\Excel\Excel::CSV);
            case 'export_pdf':
                $reports = DailyReport::whereIn('id', $ids)->get();
                return view('admin.daily-reports.pdf', compact('reports'));
        }

        return back()->with('success', 'تم تنفيذ الإجراء الجماعي بنجاح.');
    }

    public function clientsWithoutReport(Request $request)
    {
        $today = Carbon::today();

        // Get IDs of clients who submitted a report today
        $reportedClientIds = DailyReport::whereDate('report_date', $today)
            ->pluck('client_id')
            ->unique()
            ->toArray();

        $query = Client::with('city')
            ->where('status', 'active')
            ->whereNotIn('id', $reportedClientIds);

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $clients = $query->orderBy('name')->paginate(20)->withQueryString();
        $cities  = City::all();
        $date    = $today->format('Y-m-d');

        return view('admin.daily-reports.clients-without-report', compact('clients', 'cities', 'date'));
    }
}
