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

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = Client::latest()
        ->when($request->search, function ($q) use ($request) {
            $q->search($request->search);
        })
        ->paginate(10);

        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        $cities = City::all();
        return view('clients.create', compact('cities'));
    }



    public function store(ClientRequest $request)
    {
        $data = $request->validated();

        Client::create($data);
        return redirect()
            ->route('clients.index')
            ->with('success', 'تم إضافة العميل بنجاح');
    }

    public function edit(Client $client)
    {
        $cities = City::all();
        return view('clients.edit', compact('client', 'cities'));
    }

    public function update(ClientRequest $request, Client $client)
    {
        $data = $request->validated();

        if ($request->hasFile('identification_photo')) {

            if ($client->identification_photo) {
                Storage::delete($client->identification_photo);
            }

            $data['identification_photo'] =
                $request->file('identification_photo')->store('clients','public');
          
        }

        $client->update($data);

        return redirect()
            ->route('clients.index')
            ->with('success', 'تم تعديل العميل بنجاح');
    }

        public function destroy(Client $client)
        {
            foreach ($client->contracts as $contract) {

                foreach ($contract->installments as $installment) {

                    $installment->payments()->delete();

                    $installment->delete();
                }

                $contract->delete();
            }

            $client->delete();

            return back()->with(
                'success',
                'تم حذف العميل وجميع بياناته'
            );
        }

    // Restore deleted client
    public function restore($id)
    {
        Client::withTrashed()->findOrFail($id)->restore();

        return back()->with('success', 'Client restored successfully');
    }

    // Soft deleted list
    public function trashed()
    {
        $clients = Client::onlyTrashed()->paginate(10);

        return view('clients.trashed', compact('clients'));
    }

    public function exportExcel()
    {
        return Excel::download(
            new ClientsExport(),
            'clients.xlsx'
        );
    }

   public function print()
{
    $clients = Client::with('contracts')->get();
    return view('clients.print', compact('clients'));
}



}