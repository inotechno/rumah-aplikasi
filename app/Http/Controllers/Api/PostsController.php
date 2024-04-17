<?php

namespace App\Http\Controllers\Api;

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

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $posts = Post::paginate(5);
            return $this->sendResponse($posts, 'Posts retrieved successfully');
        } catch (\Throwable $th) {
            return $this->sendError('Error exception.', $th->getMessage());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try {
            $data['post'] = Post::with('category')->where('slug_title', $slug)->first();
            $data['latest_posts'] = Post::where('slug_title', '!=', $slug)->get();

            return $this->sendResponse($data, 'Post detail retrieved successfully');
        } catch (\Throwable $th) {
            return $this->sendError('Error exception.', $th->getMessage());
        }
    }
}
