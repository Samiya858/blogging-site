<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    
    // Public Posts
    

    // Show all posts (public)
    public function publicIndex()
    {
        $posts = Post::latest()->simplepaginate(10); 
        return view('public-post', compact('posts'));
    }

    // Show single post detail
    public function show(Post $post)
    {
        
        $post->load('comments');
        return view('details', compact('post'));
    }

   
    // Admin Posts (CRUD)

    // Store post from add-post form
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Post added successfully!');
    }

    // Dashboard stats
   public function dashboard()
{
    $userId = auth()->id();

    $totalPosts = Post::where('user_id', $userId)->count();   
    $latestPost = Post::where('user_id', $userId)->latest()->first(); 

    return view('admin.dashboard', [
        'totalPosts' => $totalPosts,
        'latestPost' => $latestPost
    ]);
}


    // Manage (list) posts
   public function index()
{
    $posts = Post::with('user')
        ->where('user_id', auth()->id()) //  sirf logged-in user ki posts
        ->latest()
        ->paginate(10);

    return view('admin.manage-posts', compact('posts'));
}

    // Edit form
    public function edit(Post $post)
    {
        if (auth()->id() !== $post->user_id && optional(auth()->user())->role !== 'admin') {
            abort(403);
        }
        return view('admin.edit-post', compact('post'));
    }

    // Update
    public function update(Request $request, Post $post)
    {
        if (auth()->id() !== $post->user_id && optional(auth()->user())->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post->update($request->only('title', 'content'));

        return redirect()->route('admin.managePosts')->with('success', 'Post updated successfully!');
    }

    // Delete
    public function destroy(Post $post)
    {
        if (auth()->id() !== $post->user_id && optional(auth()->user())->role !== 'admin') {
            abort(403);
        }

        $post->delete();

        return redirect()->route('admin.managePosts')->with('success', 'Post deleted successfully!');
    }

    
}
