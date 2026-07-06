<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Client;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\ClientsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::latest()
        ->when($request->search, function ($q) use ($request) {
            $q->search($request->search);
        })
        ->paginate(10);

        return view('city.index', compact('cities'));
    }

    public function create()
    {
       
        return view('city.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        City::create($request->all());
        return redirect()
            ->route('cities.index')
            ->with('success', 'تم إضافة المدينة بنجاح');
    }

    public function edit(City $city)
    {
        $cities = City::all();
        return view('city.edit', compact('city', 'cities'));
    }

    public function update(Request $request, City $city)
    {
          $request->validate([
            'name' => 'required|string|max:100',
        ]);
        
        $city->update($request->all());

        return redirect()
            ->route('cities.index')
            ->with('success', 'تم تعديل المدينة بنجاح');
    }

public function destroy(City $city)
        {
            $city->delete();
            return back()->with(
                'success',
                'تم حذف المدينة وجميع بياناته'
            );
        }


}