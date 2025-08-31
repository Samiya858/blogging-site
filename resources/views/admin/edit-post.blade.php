@extends('admin.layout')

@section('title', 'Edit Post')

@section('content')
    <h3 class="text-xl font-semibold">Edit Post</h3>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded my-3">
            <ul>
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.updatePost', $post->id) }}" method="POST" class="mt-5 bg-white p-4 rounded shadow">
        @csrf
        @method('PUT')

        <label class="block">Title:</label>
        <input type="text" name="title" value="{{ old('title', $post->title) }}" class="border rounded w-full p-2" required>

        <label class="block mt-4">Content:</label>
        <textarea name="content" class="border rounded w-full p-2" rows="8" required>{{ old('content', $post->content) }}</textarea>

        <div class="mt-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('admin.managePosts') }}" class="ml-2 text-gray-700">Cancel</a>
        </div>
    </form>
@endsection
