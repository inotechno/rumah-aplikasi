<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class RecentBlog extends Component
{
    public function render()
    {
        $posts = Post::limit(3)->get();
        return view('livewire.recent-blog', compact('posts'));
    }
}
