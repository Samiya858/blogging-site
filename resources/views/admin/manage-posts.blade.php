@extends('admin.layout')

@section('title', 'Manage Posts')

@section('content')
    <h3 class="text-xl font-semibold">Manage Posts</h3>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded my-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-5 bg-white p-4 rounded shadow overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 text-left">ID</th>
                    <th class="p-2 text-left">Title</th>
                    <th class="p-2 text-left">Author</th>
                    <th class="p-2 text-left">Created At</th>
                    <th class="p-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr class="border-t">
                        <td class="p-2">{{ $post->id }}</td>
                        <td class="p-2">{{ $post->title }}</td>
                        <td class="p-2">{{ $post->user->name ?? '—' }}</td>
                        <td class="p-2">{{ $post->created_at->format('Y-m-d') }}</td>
                        <td class="p-2">
                            <a href="{{ route('admin.editPost', $post->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded mr-2">Edit</a>

                            <form action="{{ route('admin.deletePost', $post->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-4" colspan="5">No posts yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $posts->links() }} {{-- pagination --}}
        </div>
    </div>
@endsection
