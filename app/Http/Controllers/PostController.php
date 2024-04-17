<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\URL;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Storage;
use Artesaos\SEOTools\Facades\OpenGraph;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $post = Post::with('category');

            // dd($order);
            return DataTables::eloquent($post)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu" style="">
                                    <a class="dropdown-item" href="' . route('post.edit', $row->id) . '"><i class="bx bx-edit-alt me-2"></i>
                                    Edit</a>
                                    <a class="dropdown-item btn-delete" data-id="' . $row->id . '" data-title="' . $row->title . '"  href="javascript:void(0);"><i class="bx bx-trash me-2"></i>
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
        $tags = Tag::all();
        $categories = Category::all();
        return view('post.create', compact('categories', 'tags'));
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
            'title' => 'required|unique:posts,title|min:10',
            'category_id' => 'required|numeric',
            'img_thumbnail' => 'required|mimes:jpg,png,jpeg|max:5000',
            'url_post' => 'active_url',
            'description'   => 'required|min:10',
            'description_excerpt'   => 'required|min:15|max:255',
            'status_post'      => 'required'
        ]);

        // dd($validate);

        $validate['slug_title'] = Str::slug($request->title, '-');

        if ($request->file('img_thumbnail')) {
            $img_thumbnail = $request->file('img_thumbnail');
            $validate['img_thumbnail'] = $validate['slug_title'] . '-' . time() . '1.' . $img_thumbnail->extension();

            $destinationPath = public_path('/storage/posts');
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
            $post = Post::create($validate);
            // dd($category);
            if ($request->has('tags')) {
                $post->tags()->attach($request->tags);
            }

            $request->session()->flash('success', 'Post berhasil ditambahkan');
            return redirect()->route('post.index');
        } catch (\Throwable $th) {
            return back()->with('error', $th);
        }
    }

    public function all()
    {
        SEOTools::setTitle('Postingan RumahAplikasi');
        SEOTools::setDescription('Halaman ini berisi postingan yang ada di rumahaplikasi terkait perkembangan teknologi');
        SEOTools::opengraph()->setUrl(URL::full());
        SEOTools::setCanonical(URL::full());
        SEOTools::opengraph()->addProperty('type', 'webpage');
        SEOTools::twitter()->setSite('@' . config('settings.app_name'));

        $posts = Post::paginate(2);
        $categories = Category::with('posts')->get();

        foreach ($posts as $post) {
            OpenGraph::addImage(['url' => url('storage/posts/' . $post->img_thumbnail), 'size' => 300]);
        }
        // dd($categories);
        return view('landing_page.posts', compact('posts', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::with('category')->where('slug_title', $slug)->first();
        $latest_posts = Post::where('slug_title', '!=', $slug)->get();

        SEOTools::setTitle($post->title);
        SEOTools::setDescription($post->description_excerpt);
        SEOTools::opengraph()->setUrl(URL::full());
        SEOTools::setCanonical(URL::full());
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@' . config('settings.app_name'));
        OpenGraph::addImage(['url' => url('storage/posts/' . $post->img_thumbnail), 'size' => 300]);

        return view('landing_page.post-detail', compact('post', 'latest_posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::all();
        $post = Post::with('category', 'tags')->find($id);
        // dd($post);
        $categories = Category::all();
        return view('post.edit', compact('categories', 'post', 'tags'));
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
        $post = Post::find($id);
        $validate = $request->validate([
            'title'                 => 'required|min:10|unique:posts,title,' . $post->id,
            'category_id'            => 'required|numeric',
            'img_thumbnail'         => 'mimes:jpg,png,jpeg|max:5000',
            'description'           => 'required|min:10',
            'description_excerpt'   => 'required|min:15|max:255',
            'status_post'      => 'required'
        ]);

        // dd($validate);
        $description = $request->description;
        $data['title'] = $request->title;
        $data['category_id'] = $request->category_id;
        $data['url_post'] = $request->url_post;
        $data['description_excerpt'] = $request->description_excerpt;
        $data['status_post'] = $request->status_post;
        $data['slug_title'] = Str::slug($request->title, '-');

        if ($request->file('img_thumbnail')) {
            $img_thumbnail = $request->file('img_thumbnail');
            $data['img_thumbnail'] = $data['slug_title'] . '-' . time()  . $img_thumbnail->extension();

            $destinationPath = public_path('/storage/posts');
            $img_thumbnail->move($destinationPath, $data['img_thumbnail']);

            Storage::delete('posts/' . $request->img_thumbnail_old);
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
            $post->update($data);
            // dd($category);
            $post->tags()->sync($request->taggable);

            $request->session()->flash('success', 'Post berhasil diubah');
            return redirect()->route('post.index');
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
        $post = Post::find($id);
        try {
            $post->delete();
            return redirect()->route('post.index')->with('success', 'Post berhasil dihapus');
        } catch (\Throwable $th) {
            return back()->with('error', $th);
        }
    }
}
