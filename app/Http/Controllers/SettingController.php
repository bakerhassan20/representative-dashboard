<?php
namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::firstOrCreate([]);

        $settings->update([
            'site_name' => $request->site_name,
            'site_description' => $request->site_description,
            'primary_color' => $request->primary_color,
            'dark_mode' => $request->has('dark_mode'),
           
        ]);
         if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->move(public_path('uploads/settings'), $filename);

            $settings->update([
                'logo' => $filename,
            ]);
        }   

        return back()->with('success', 'Settings updated');
    }
}