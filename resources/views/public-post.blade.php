<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BlogSphere - Posts</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f3f4f6; /* gray-100 */
      min-height: 100vh;
    }
    .post-card {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.08);
      transition: all 0.2s ease;
    }
    .post-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }
    .btn-link {
      background: #1f2937; /* gray-800 */
      color: white;
      padding: 8px 14px;
      border-radius: 6px;
      font-weight: 500;
      transition: all 0.2s ease;
    }
    .btn-link:hover {
      background: #374151; /* gray-700 */
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="fixed top-0 left-0 right-0 bg-gray-800 shadow-md z-50">
    <div class="container mx-auto flex justify-between items-center p-4">
      <div class="text-2xl font-bold text-white">BlogSphere</div>
      <div class="space-x-6 hidden md:flex font-medium text-gray-200">
        <a href="{{ url('/') }}" class="hover:text-gray-300">Home</a>
        <a href="{{ url('/about') }}" class="hover:text-gray-300">About</a>
        <a href="{{ url('/contact') }}" class="hover:text-gray-300">Contact</a>
      </div>
      <div class="md:hidden">
        <button class="focus:outline-none">
          <svg class="w-6 h-6 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16m-7 6h7"></path>
          </svg>
        </button>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="mt-24 container mx-auto px-4 max-w-3xl">
    <div class="space-y-8">
      <!-- Loop Through Posts -->
      @foreach ($posts as $post)
        <div class="post-card p-6">
          <h2 class="text-2xl font-bold text-gray-800 mb-3">
            {{ $post->title }}
          </h2>
          <p class="text-gray-600 leading-relaxed mb-4">
            {{ Str::limit($post->content, 180, '...') }}
          </p>
          <!-- Read More button -->
<a href="{{ route('posts.show', $post->id) }}" 
   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
   Read More →
</a>

        </div>
      @endforeach
    </div>

   <!-- Pagination -->
<div class="mt-10 flex justify-center">
  <div class="flex space-x-3">
    <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Previous</a>
    <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Next</a>
  </div>
</div>

  </main>

  <!-- Footer -->
  <footer class="bg-gray-800 text-gray-300 text-center py-6 mt-16 shadow-inner">
    <p class="text-sm">© {{ date('Y') }} BlogSphere</p>
    <div class="flex justify-center space-x-6 mt-2">
      <a href="#" class="hover:text-gray-300">Facebook</a>
      <a href="#" class="hover:text-gray-300">Twitter</a>
      <a href="#" class="hover:text-gray-300">LinkedIn</a>
    </div>
  </footer>

</body>
</html>
