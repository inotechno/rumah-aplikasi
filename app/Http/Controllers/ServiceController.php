<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('service.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $service = Service::query();

            // dd($order);
            return DataTables::eloquent($service)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu" style="">
                                    <a class="dropdown-item" href="' . route('service.edit', $row->id) . '"><i class="bx bx-edit-alt me-2"></i>
                                    Edit</a>
                                    <a class="dropdown-item btn-delete" data-id="' . $row->id . '" data-name="' . $row->service_name . '"  href="javascript:void(0);"><i class="bx bx-trash me-2"></i>
                                    Delete</a>
                                </div>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = $request->validate([
            'service_name' => 'required|unique:services,service_name',
            'service_description' => 'required|min:10',
        ]);

        try {
            // dd($request);
            $service = Service::create([
                'service_name'        => $request->service_name,
                'service_slug'        => Str::slug($request->service_name, '-'),
                'service_icon'        => $request->service_icon,
                'service_description' => $request->service_description,
            ]);

            // dd($service);

            $request->session()->flash('success', 'Service berhasil ditambahkan');
            return redirect()->route('service.index');
        } catch (\Throwable $th) {
            return back()->with('error', $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        return view('service.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        $validator = $request->validate([
            'service_name' => 'required|unique:services,service_name,' . $service->id,
            'service_description' => 'required|min:10',
        ]);

        try {
            $service->update([
                'service_name'        => $request->service_name,
                'service_slug'        => Str::slug($request->service_name, '-'),
                'service_icon'        => $request->service_icon,
                'service_description' => $request->service_description,
            ]);

            // dd($service);

            $request->session()->flash('success', 'Service berhasil diubah');
            return redirect()->route('service.index');
        } catch (\Throwable $th) {
            return back()->with('error', $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);

        if ($service) {
            try {
                $service->delete();
                return redirect()->route('service.index')->with('success', 'Service berhasil dihapus');
            } catch (\Throwable $th) {
                return back()->with('error', $th);
            }
        } else {
            return back()->with('error', 'Service tidak ditemukan');
        }
    }
}
