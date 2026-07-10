<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDailyReportRequest;
use App\Models\City;
use App\Models\Client;
use App\Models\DailyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DailyReportController extends Controller
{
    public function getClientInfo(Request $request)
    {
        $client = Client::with('city')->where('id_number', $request->id_number)->first();
        if ($client) {
            return response()->json([
                'success' => true,
                'name' => $client->name,
                'city' => $client->city->name ?? 'غير محدد'
            ]);
        }
        return response()->json(['success' => false]);
    }

    public function create()
    {
        return view('daily-report.create');
    }

    public function store(StoreDailyReportRequest $request)
    {
        $client = Client::where('id_number', $request->id_number)->firstOrFail();

        if (!$client->city_id) {
            return back()
                ->withInput()
                ->withErrors([
                    'id_number' => 'حساب المندوب غير مرتبط بمدينة حالياً. يرجى مراجعة الإدارة.'
                ]);
        }

        $existingReport = DailyReport::where('client_id', $client->id)
            ->whereDate('report_date', $request->report_date)
            ->first();

        if ($existingReport) {
            if (!$existingReport->allow_resubmit) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'report_date' => 'تم إرسال تقرير هذا اليوم مسبقًا.'
                    ]);
            }

            // If resubmission is allowed, delete the old image to save storage space
            if ($existingReport->payment_image) {
                Storage::disk('public')->delete($existingReport->payment_image);
            }

            $image = $request->file('payment_image')
                ->store('daily-reports', 'public');

            $existingReport->update([
                'phone' => $request->phone,
                'earned_amount' => $request->earned_amount,
                'completed_orders_count' => $request->completed_orders_count,
                'rejected_orders_count' => $request->rejected_orders_count,
                'delivery_hours' => $request->delivery_hours,
                'vehicle_type' => $request->vehicle_type,
                'payment_image' => $image,
                'notes' => $request->notes,
                'status' => 'pending',
                'allow_resubmit' => false,
            ]);

            return redirect()
                ->back()
                ->with('success', 'تم تحديث وإعادة إرسال التقرير بنجاح.');
        }

        $image = $request->file('payment_image')
            ->store('daily-reports', 'public');

        DailyReport::create([
            'client_id' => $client->id,
            'city_id' => $client->city_id,
            'phone' => $request->phone,
            'report_date' => $request->report_date,
            'earned_amount' => $request->earned_amount,
            'completed_orders_count' => $request->completed_orders_count,
            'rejected_orders_count' => $request->rejected_orders_count,
            'delivery_hours' => $request->delivery_hours,
            'vehicle_type' => $request->vehicle_type,
            'payment_image' => $image,
            'notes' => $request->notes,
            'status' => 'pending',
            'allow_resubmit' => false,
        ]);

        return redirect()
            ->back()
            ->with('success', 'تم إرسال التقرير بنجاح.');
    }
}
