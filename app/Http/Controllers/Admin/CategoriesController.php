<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoriesController extends Controller
{
    public function __construct(Category $category, Post $post){
        $this->category = $category;
        $this->post = $post;
    }

    public function index(){
        $all_categories = $this->category->orderBy('name')->paginate(10);

        //count posts without category
        $all_posts = $this->post->all();
        $uncategorized_posts = 0;
        foreach($all_posts as $post){
            if($post->categoryPosts->count() == 0)
                $uncategorized_posts++;
        }

        return view('admin.categories.index')->with('all_categories', $all_categories)
                                            ->with('uncategorized_count', $uncategorized_posts);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:50|unique:categories,name'
        ]);

        $this->category->name = $request->name;
        $this->category->save();

        return redirect()->back();
    }

    public function delete($id){
        $this->category->destroy($id);
        return redirect()->route('admin.categories');
    }

    public function update(Request $request, $id){
        $request->validate([
            'categ_name'.$id => 'required|max:50|unique:categories,name,'.$id
        ],[
            "categ_name.$id.required" => 'The name is required.',
            "categ_name.$id.max" => 'Maximum of 50 characters only.',
            "categ_name.$id.unique" => 'The name already exists.'
        ]);

        $categ = $this->category->findOrFail($id);
        $categ->name = $request->input('categ_name'.$id);
        $categ->save();

        return redirect()->back();
    }
}
