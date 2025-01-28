<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    private $category; 
    private $post;

    public function __construct(Category $category, Post $post){
        $this->category = $category;
        $this->post = $post;
    }

    public function create(){
        $all_categories = $this->category->all();

        return view('user.posts.create')->with('all_categories', $all_categories);
    }

    public function store(Request $request){
        //validation
        $request->validate([
            'categories' => 'required|array|between:1,3',
            'description' => 'required|max:1000',
            'image' => 'required|max:1048|mimes:jpg,jpeg,png,gif'
        ]);

        $this->post->description = $request->description;
        $this->post->user_id = Auth::user()->id;
        $this->post->image = "data:image/".$request->image->extension().";base64,".base64_encode(file_get_contents($request->image));
        $this->post->save();

        //save categories
        $category_posts = [];
        foreach($request->categories as $category_id){
            $category_posts []= ['category_id' => $category_id];
        }
        // [
        //     ['category_id' => 1],
        //     ['category_id' => 2]
        // ]
        $this->post->categoryPosts()->createMany($category_posts);

        //solution 2: one by one insert
        // foreach($request->categories as $category_id){
        //     CategoryPost::create([
        //         'category_id' => $category_id,
        //         'post_id' => $this->post->id
        //     ]);
        // }

        return redirect()->route('home');
    }

    public function show($id){
        //get the data of 1 post where ID = $id
        $post_a = $this->post->findOrFail($id);

        return view('user.posts.show')->with('post', $post_a);
    }

    public function edit($id){

        $post_a = $this->post->findOrFail($id);
        $all_categories = $this->category->all();

        //get current post categories
        $selected_categories = [];
        foreach($post_a->categoryPosts as $category_post){
            $selected_categories []= $category_post->category_id;
        }

        return view('user.posts.edit')->with('post', $post_a)
                                        ->with('all_categories', $all_categories)
                                        ->with('selected_categories', $selected_categories);
    }

    public function update(Request $request, $id){
        $request->validate([
            'categories' => 'required|array|between:1,3',
            'description' => 'required|max:1000',
            'image' => 'max:1048|mimes:jpeg,jpg,png,gif'
        ]);

        $post_a = $this->post->findOrFail($id);
        $post_a->description = $request->description;
        if($request->image){
            $post_a->image = "data:image/".$request->image->extension().";base64,".base64_encode(file_get_contents($request->image));
        }
        $post_a->save();

        //delete related category_posts to edited post
        $post_a->categoryPosts()->delete();

        $category_posts = [];
        foreach($request->categories as $category_id){
            $category_posts []= ['category_id' => $category_id];
        }
        $post_a->categoryPosts()->createMany($category_posts);

        //redirect to Show Post
        return redirect()->route('post.show', $id);
    }

    public function delete($id){
        // $this->post->destroy($id);
        $this->post->findOrFail($id)->forceDelete();

        return redirect()->route('home');
    }
}
