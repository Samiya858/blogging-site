@extends('admin.layout')

@section('title', 'Manage Comments')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-2xl font-semibold text-gray-800 border-b pb-3">Manage Comments</h3>

        <div class="overflow-x-auto mt-5">
            <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-100 text-left text-gray-700 text-sm uppercase tracking-wider">
                        <th class="p-3">Author</th>
                        <th class="p-3">Comment</th>
                        <th class="p-3">Related Post</th>
                        <th class="p-3">Date</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse($comments as $comment)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-3 font-medium">{{ $comment->user->name }}</td>
                            <td class="p-3">{{ $comment->content }}</td>
                            <td class="p-3 text-blue-600 font-semibold">
                                {{ $comment->post->title }}
                            </td>
                            <td class="p-3 text-sm text-gray-500">
                                {{ $comment->created_at->format('M d, Y') }}
                            </td>
                            <td class="p-3">
                                <span class="px-2 py-1 text-xs font-semibold rounded 
                                    {{ $comment->status == 'approved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($comment->status) }}
                                </span>
                            </td>
                            <td class="p-3 flex space-x-2">
                                @if($comment->status !== 'approved')
                                    <a href="{{ route('comments.approve', $comment->id) }}"
                                        class="bg-green-500 hover:bg-green-600 text-white text-xs px-3 py-1 rounded shadow">
                                        Approve
                                    </a>
                                @endif
                                <a href="{{ route('comments.delete', $comment->id) }}"
                                    class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded shadow">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-6 text-gray-500">
                                No comments found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
