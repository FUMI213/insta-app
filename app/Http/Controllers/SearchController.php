<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
        
        $posts = Post::query()
            ->where('description', 'LIKE', "%{$search}%")
            ->orWhereHas('user', function($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('categoryPosts.category', function($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->paginate(10);
        
        return view('search.index', compact('posts', 'search'));
    }
}