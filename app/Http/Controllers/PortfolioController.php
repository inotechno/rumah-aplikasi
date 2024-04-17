<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Portfolio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\URL;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Storage;
use Artesaos\SEOTools\Facades\OpenGraph;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('portfolio.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $portfolio = Portfolio::with('service');

            // dd($order);
            return DataTables::eloquent($portfolio)
                ->addIndexColumn()
                ->addColumn('_title', function ($row) {
                    return substr($row->title, 0, 40) . ' ...';
                })
                ->addColumn('_description_excerpt', function ($row) {
                    return substr($row->description_excerpt, 0, 40) . ' ...';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu" style="">
                                    <a class="dropdown-item" href="' . route('portfolio.edit', $row->id) . '"><i class="bx bx-edit-alt me-2"></i>
                                    Edit</a>
                                    <a class="dropdown-item btn-delete" data-id="' . $row->id . '" data-title="' . $row->title . '"  href="javascript:void(0);"><i class="bx bx-trash me-2"></i>
                                    Delete</a>
                                </div>
                            </div>';
                })
                ->rawColumns(['action', '_title', '_description_excerpt'])
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
        $services = Service::all();
        return view('portfolio.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        $validate = $request->validate([
            'title' => 'required|unique:portfolios,title|min:10',
            'service_id' => 'required|numeric',
            'img_thumbnail' => 'required|mimes:jpg,png,jpeg|max:5000',
            'url_portfolio' => 'active_url',
            'description'   => 'required|min:10',
            'description_excerpt'   => 'required|min:15|max:255',
            'status_portfolio'      => 'required'
        ]);

        // dd($validate);

        $validate['slug_title'] = Str::slug($request->title, '-');

        if ($request->file('img_thumbnail')) {
            $img_thumbnail = $request->file('img_thumbnail');
            $validate['img_thumbnail'] = $validate['slug_title'] . '-' . time() . '1.' . $img_thumbnail->extension();

            $destinationPath = public_path('/storage/portfolios');
            $img_thumbnail->move($destinationPath, $validate['img_thumbnail']);
        }

        $dom = new \DomDocument();
        $dom->loadHtml($validate['description'], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $item => $image) {
            $dt = $image->getAttribute('src');
            if (array_key_exists(1, explode(';', $dt))) {
                list($type, $dt) = explode(';', $dt);
                list(, $dt)      = explode(',', $dt);
                $imgedt = base64_decode($dt);
                $image_name = "/img/upload/" . time() . $item . '.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $imgedt);

                $image->removeAttribute('src');
                $image->setAttribute('src', $image_name);
            }
        }

        $validate['description'] = $dom->saveHTML();

        try {
            // dd($request);
            $portfolio = Portfolio::create($validate);
            // dd($service);

            $request->session()->flash('success', 'Portfolio berhasil ditambahkan');
            return redirect()->route('portfolio.index');
        } catch (\Throwable $th) {
            return back()->with('error', $th);
        }
    }

    public function all(Request $request)
    {
        SEOTools::setTitle('Portfolio Rumah Aplikasi');
        SEOTools::setDescription('Halaman ini digunakan untuk menampilkan semua aplikasi yang di buat oleh rumah aplikasi.');
        SEOTools::opengraph()->setUrl(URL::full());
        SEOTools::setCanonical(URL::full());
        SEOTools::opengraph()->addProperty('type', 'webpage');
        SEOTools::twitter()->setSite('@' . config('settings.app_name'));

        // dd($request->get('search'));
        $portfolios = Portfolio::paginate(4);
        if ($request->get('search')) {
            $portfolios = Portfolio::where('title', 'LIKE', '%' . $request->search . '%')->orWhere('description', 'LIKE', '%' . $request->search . '%')->paginate(4);
        }
        $services = Service::with('portfolios')->get();

        foreach ($portfolios as $portfolio) {
            OpenGraph::addImage(['url' => url('storage/portfolios/' . $portfolio->img_thumbnail), 'size' => 300]);
        }

        // dd($portfolios);
        return view('landing_page.portfolios', compact('portfolios', 'services'))->with('i', (request()->input('page', 1) - 1) * 4);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $portfolio = Portfolio::with('service')->where('slug_title', $slug)->first();
        $latest_portfolios = Portfolio::where('slug_title', '!=', $slug)->get();

        SEOTools::setTitle($portfolio->title);
        SEOTools::setDescription($portfolio->description_excerpt);
        SEOTools::opengraph()->setUrl(URL::full());
        SEOTools::setCanonical(URL::full());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@' . config('settings.app_name'));
        OpenGraph::addImage(['url' => url('storage/portfolios/' . $portfolio->img_thumbnail), 'size' => 300]);

        return view('landing_page.portfolio-detail', compact('portfolio', 'latest_portfolios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $portfolio = Portfolio::with('service')->find($id);
        $services = Service::all();
        // dd($portfolio);
        return view('portfolio.edit', compact('services', 'portfolio'));
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
        // dd($request);
        $portfolio = Portfolio::find($id);
        $validate = $request->validate([
            'title'                 => 'required|min:10|unique:portfolios,title,' . $portfolio->id,
            'service_id'            => 'required|numeric',
            'img_thumbnail'         => 'mimes:jpg,png,jpeg|max:5000',
            'description'           => 'required|min:10',
            'description_excerpt'   => 'required|min:15|max:255',
            'status_portfolio'      => 'required'
        ]);

        // dd($validate);
        $description = $request->description;
        $data['title'] = $request->title;
        $data['service_id'] = $request->service_id;
        $data['url_portfolio'] = $request->url_portfolio;
        $data['description_excerpt'] = $request->description_excerpt;
        $data['status_portfolio'] = $request->status_portfolio;
        $data['slug_title'] = Str::slug($request->title, '-');

        if ($request->file('img_thumbnail')) {
            $img_thumbnail = $request->file('img_thumbnail');
            $data['img_thumbnail'] = $data['slug_title'] . '-' . time()  . $img_thumbnail->extension();

            $destinationPath = public_path('/storage/portfolios');
            $img_thumbnail->move($destinationPath, $data['img_thumbnail']);

            Storage::delete('portfolios/' . $request->img_thumbnail_old);
        }

        $dom = new \DomDocument();
        $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $item => $image) {
            $dt = $image->getAttribute('src');
            // dd(explode(';', $dt));
            if (array_key_exists(1, explode(';', $dt))) {
                list($type, $dt) = explode(';', $dt);
                list(, $dt)      = explode(',', $dt);
                $imgedt = base64_decode($dt);
                $image_name = "/img/upload/" . time() . $item . '.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $imgedt);

                $image->removeAttribute('src');
                $image->setAttribute('src', $image_name);
            }
        }

        // dd($data);
        $data['description'] = $dom->saveHTML();
        try {
            // dd($request);
            $portfolio->update($data);
            // dd($service);

            $request->session()->flash('success', 'Portfolio berhasil diubah');
            return redirect()->route('portfolio.index');
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
        $portfolio = Portfolio::find($id);
        try {
            $portfolio->delete();
            return redirect()->route('portfolio.index')->with('success', 'Portfolio berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('error', $th);
        }
    }
}
