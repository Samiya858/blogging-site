<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
   public function store(Request $request, Post $post)
{
    $request->validate([
        'content' => 'required|string',
    ]);

    $comment = new Comment();
    $comment->content = $request->content;
    $comment->post_id = $post->id;
    $comment->user_id = auth()->id();
    $comment->status = 'pending'; 
    $comment->save();

    return redirect()->route('posts.show', $post->id)
                     ->with('success', 'Your comment is submitted and waiting for approval.');
}


    public function manageComments()
{
    // sirf current user ki posts par aane wale comments
    $comments = Comment::whereHas('post', function($q) {
        $q->where('user_id', Auth::id());
    })->with(['user', 'post'])->latest()->get();

    return view('admin.manage-comments', compact('comments'));
}

public function approve($id)
{
    $comment = Comment::findOrFail($id);
    $comment->status = 'approved';
    $comment->save();

    return back()->with('success', 'Comment approved successfully!');
}

public function delete($id)
{
    $comment = Comment::findOrFail($id);
    $comment->delete();

    return back()->with('success', 'Comment deleted successfully!');
}

}
