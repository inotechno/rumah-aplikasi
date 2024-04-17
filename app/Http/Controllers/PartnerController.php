<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        return view('partner.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $partner = Partner::query();

            // dd($order);
            return DataTables::eloquent($partner)
                ->addIndexColumn()
                ->addColumn('logo_img', function ($row) {
                    return '<img class="img-fluid" src="' . asset('storage/partners/' . $row->logo) . '">';
                })
                ->addColumn('sosial_media', function ($row) {
                    $sm = "";

                    if ($row->facebook_link != null) {
                        $sm .= '<i class="bx bxl-facebook-square"></i>';
                    }

                    if ($row->website_link != null) {
                        $sm .= '<i class="bx bx-globe"></i>';
                    }

                    if ($row->twitter_link != null) {
                        $sm .= '<i class="bx bxl-twitter"></i>';
                    }

                    if ($row->linkedin_link != null) {
                        $sm .= '<i class="bx bxl-linkedin-square"></i>';
                    }

                    return $sm;
                })
                ->addColumn('action', function ($row) {
                    return '<div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu" style="">
                                    <a class="dropdown-item" href="' . route('partner.edit', $row->id) . '"><i class="bx bx-edit-alt me-2"></i>
                                    Edit</a>
                                    <a class="dropdown-item btn-delete" data-id="' . $row->id . '" data-name="' . $row->name . '"  href="javascript:void(0);"><i class="bx bx-trash me-2"></i>
                                    Delete</a>
                                </div>
                            </div>';
                })
                ->rawColumns(['action', 'logo_img', 'sosial_media'])
                ->make(true);
        }
    }

    public function create()
    {
        return view('partner.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = $request->validate([
            'name' => 'required',
            'logo' => 'required|mimes:jpg,png,jpeg|max:5000',
        ]);

        if ($request->file('logo')) {
            $logo = $request->file('logo');
            $validator['logo'] = time() . '.' . $logo->extension();

            $destinationPath = public_path('/storage/partners');
            $logo->move($destinationPath, $validator['logo']);
        }

        $validator['website_link'] = $request->website_link;
        $validator['facebook_link'] = $request->facebook_link;
        $validator['instagram_link'] = $request->instagram_link;
        $validator['twitter_link'] = $request->twitter_link;
        $validator['linkedin_link'] = $request->linkedin_link;

        // dd($validator);
        try {
            // dd($request);
            $partner = Partner::create($validator);
            // dd($service);

            $request->session()->flash('success', 'Partner berhasil ditambahkan');
            return redirect()->route('partner.index');
        } catch (\Throwable $th) {
            return back()->with('error', $th);
        }
    }

    public function edit($id)
    {
        $partner = Partner::find($id);
        // dd(compact('partner'));
        return view('partner.edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $partner = Partner::find($id);

        $validator = $request->validate([
            'name' => 'required',
            'logo' => 'mimes:jpg,png,jpeg|max:5000',
        ]);

        if ($request->file('logo')) {
            $logo = $request->file('logo');
            $validator['logo'] = time() . '.' . $logo->extension();

            $destinationPath = public_path('/storage/partners');
            $logo->move($destinationPath, $validator['logo']);

            Storage::delete('partners/' . $request->logo_old);
        }

        $validator['website_link'] = $request->website_link;
        $validator['facebook_link'] = $request->facebook_link;
        $validator['instagram_link'] = $request->instagram_link;
        $validator['twitter_link'] = $request->twitter_link;
        $validator['linkedin_link'] = $request->linkedin_link;

        // dd($validator);
        try {
            // dd($request);
            $partner->update($validator);
            // dd($service);

            $request->session()->flash('success', 'partner berhasil diubah');
            return redirect()->route('partner.index');
        } catch (\Throwable $th) {
            return back()->with('error', $th);
        }
    }

    public function destroy($id)
    {
        $partner = Partner::find($id);

        try {
            $partner->delete();
            return redirect()->route('partner.index')->with('success', 'Partner berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('error', $th);
        }
    }
}
