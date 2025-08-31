<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $post->title }} - BlogSphere</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f9fafb;
      min-height: 100vh;
    }
    .btn-primary {
      background: #3b82f6; /* blue-500 */
      color: white;
      padding: 0.6rem 1.5rem;
      border-radius: 8px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    .btn-primary:hover {
      background: #2563eb; /* blue-600 */
    }
  </style>
</head>
<body>

  <!-- Main Content -->
  <main class="container mx-auto px-4 mt-20 max-w-3xl">
    <!-- Post Title -->
    <h1 class="text-4xl font-extrabold text-center text-blue-600">{{ $post->title }}</h1>
    
    <!-- Meta Information -->
    <p class="text-gray-500 text-sm text-center mt-3">
      By <span class="font-medium text-gray-700">{{ $post->user->name ?? 'Admin' }}</span> • 
      Published on {{ $post->created_at->format('M d, Y') }}
    </p>

    <!-- Post Content -->
    <div class="mt-8 bg-white shadow-lg rounded-2xl p-6 leading-relaxed text-gray-800">
      {!! nl2br(e($post->content)) !!}
    </div>

    <!-- Divider -->
    <hr class="my-10 border-gray-300">

    <!-- Comments Section -->
    <h2 class="text-2xl font-bold text-blue-600 mb-4">Comments</h2>
    <div class="space-y-4 max-h-72 overflow-y-auto pr-2">
      @forelse($post->comments as $comment)
        <div class="bg-white shadow-md border border-gray-100 p-4 rounded-xl">
          <div class="flex justify-between items-center mb-1">
            <p class="font-semibold text-gray-800">{{ $comment->author }}</p>
            <span class="text-gray-500 text-xs">{{ $comment->created_at->format('M d, Y h:i A') }}</span>
          </div>
          <p class="text-gray-700 text-sm leading-relaxed">{{ $comment->content }}</p>
        </div>
      @empty
        <p class="text-gray-500 italic">No comments yet. Be the first to comment!</p>
      @endforelse
    </div>

    <!-- Add Comment Form -->
    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 mt-8 shadow-sm">
      <h3 class="text-lg font-semibold mb-3">Add a Comment</h3>
      <form action="{{ route('comments.store', $post->id) }}" method="POST" class="space-y-3">
        @csrf
        <!-- Name Field -->
        <input type="text" name="author" placeholder="Your name"
          class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>

        <!-- Comment Field -->
        <textarea name="content" rows="3" placeholder="Write your comment..."
          class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required></textarea>

        <!-- Submit Button -->
        <div class="flex justify-end">
          <button type="submit" class="btn-primary text-sm">
            Post Comment
          </button>
        </div>
      </form>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-white text-gray-700 text-center py-6 mt-16 border-t">
    <p class="text-sm">© {{ date('Y') }} BlogSphere</p>
    <div class="flex justify-center space-x-6 mt-2">
      <a href="#" class="hover:text-blue-600">Facebook</a>
      <a href="#" class="hover:text-blue-600">Twitter</a>
      <a href="#" class="hover:text-blue-600">LinkedIn</a>
    </div>
  </footer>

</body>
</html>
