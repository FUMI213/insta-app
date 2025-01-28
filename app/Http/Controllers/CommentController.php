<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller
{
    public function __construct(Comment $comment){
        $this->comment = $comment;
    }

    public function store(Request $request, $post_id){
        $request->validate([
            'comment_body'.$post_id => 'required|max:200'
        ], [
            "comment_body$post_id.required" => 'Cannot post an empty comment.',
            "comment_body$post_id.max" => 'Maximum of 200 characters only.' 
        ]);

        $this->comment->body = $request->input('comment_body'.$post_id); 
        $this->comment->post_id = $post_id;             //which post do we comment on
        $this->comment->user_id = Auth::user()->id;     //who owns the comment
        $this->comment->save();

        //redirect to previous page 
        return redirect()->back();
    }

    public function delete($id){
        $this->comment->destroy($id);

        return redirect()->back();
    }
}
