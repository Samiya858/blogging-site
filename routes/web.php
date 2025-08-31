<?php


use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
 
// Public Routes
Route::get('/', [PostController::class, 'publicIndex'])->name('public.posts');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');



// Login & Register Views
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::get('/register', [UserController::class, 'showRegister'])->name('register');

// Handle Form Submissions
Route::post('/login', [UserController::class, 'login'])->name('login.post');
Route::post('/register', [UserController::class, 'register'])->name('register.post');

// Logout
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


// Admin Dashboard
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [PostController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/add-post', function () {
        return view('admin.add-post');
    })->name('admin.addPost');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

     // Manage posts routes
    Route::get('/manage-posts', [PostController::class, 'index'])->name('admin.managePosts');
    Route::get('/manage-posts/{post}/edit', [PostController::class, 'edit'])->name('admin.editPost');
    Route::put('/manage-posts/{post}', [PostController::class, 'update'])->name('admin.updatePost');
    Route::delete('/manage-posts/{post}', [PostController::class, 'destroy'])->name('admin.deletePost');
    Route::get('/manage-comments', [CommentController::class, 'manageComments'])->name('admin.manageComments');
    Route::get('/comments/{id}/approve', [CommentController::class, 'approve'])->name('comments.approve');
    Route::get('/comments/{id}/delete', [CommentController::class, 'delete'])->name('comments.delete');
});

