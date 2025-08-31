@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <h3 class="text-xl font-semibold">Welcome back, Admin 👋</h3>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-5 bg-white p-4 rounded shadow">
        <p>Total Posts: <span>{{ $totalPosts }}</span></p>
        <p>Latest Post: <span>{{ $latestPost ? $latestPost->title : 'No posts yet' }}</span></p>
    </div>

    <div class="mt-5">
        <a href="{{ route('admin.addPost') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Post</a>
    </div>
@endsection
