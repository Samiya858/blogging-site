@extends('admin.layout')

@section('title', 'Add Post')

@section('content')
    <h3 class="text-xl font-semibold">Add New Post</h3>
    <form class="mt-5 bg-white p-4 rounded shadow" method="POST" action="{{ route('posts.store') }}">
        @csrf
        <label for="post-title" class="block">Title:</label>
        <input type="text" id="post-title" name="title" class="border rounded w-full p-2" required>
        
        <label for="post-content" class="block mt-4">Content:</label>
        <textarea id="post-content" name="content" class="border rounded w-full p-2" required></textarea>
        @if($errors->any())
    <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        
        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
@endsection
