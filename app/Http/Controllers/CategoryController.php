<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $category = Category::query();

            // dd($order);
            return DataTables::eloquent($category)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu" style="">
                                    <a class="dropdown-item" href="' . route('category.edit', $row->id) . '"><i class="bx bx-edit-alt me-2"></i>
                                    Edit</a>
                                    <a class="dropdown-item btn-delete" data-id="' . $row->id . '" data-name="' . $row->category_name . '"  href="javascript:void(0);"><i class="bx bx-trash me-2"></i>
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
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request['category_name']);
        $validator = $request->validate([
            'category_name' => 'required|unique:categories,category_name',
        ]);

        try {
            // $category = new Category();
            // $category->category_name = $request->category_name;
            // $category->category_slug = Str::slug($request->category_name, '-');
            // $category->category_icon = $request->category_icon;
            // $category->save();

            $category = Category::create([
                'category_name'        => $request->category_name,
                'category_slug'        => Str::slug($request->category_name, '-'),
                'category_icon'        => $request->category_icon,
            ]);

            // dd($category->toSql());

            $request->session()->flash('success', 'category berhasil ditambahkan');
            return redirect()->route('category.index');
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
        $category = Category::find($id);
        // dd(compact('category'));
        return view('category.edit', compact('category'));
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
        // dd($category);
        $category = Category::find($id);

        $validator = $request->validate([
            'category_name' => 'required|unique:categories,category_name,' . $category->id,
        ]);

        try {
            // dd($request);
            $category->update([
                'category_name'        => $request->category_name,
                'category_slug'        => Str::slug($request->category_name, '-'),
                'category_icon'        => $request->category_icon,
            ]);

            // dd($category);

            $request->session()->flash('success', 'category berhasil diubah');
            return redirect()->route('category.index');
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
        $category = Category::find($id);

        if ($category) {
            try {
                $category->delete();
                return redirect()->route('category.index')->with('success', 'Category success deleted');
            } catch (\Throwable $th) {
                return back()->with('error', $th);
            }
        } else {
            return back()->with('error', 'Category tidak ditemukan');
        }
    }
}
