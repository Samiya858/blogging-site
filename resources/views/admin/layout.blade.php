<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white h-screen p-5">
            <h2 class="text-2xl font-bold text-center">Admin Dashboard</h2>
            <ul class="mt-5">
                <li><a href="{{ route('admin.dashboard') }}" class="block py-2 hover:bg-gray-700 rounded">Dashboard</a></li>
                <li><a href="{{ route('admin.addPost') }}" class="block py-2 hover:bg-gray-700 rounded">Add New Post</a></li>
                <li><a href="{{ route('admin.managePosts') }}" class="block py-2 hover:bg-gray-700 rounded">Manage Posts</a></li>
                <li><a href="{{ route('admin.manageComments') }}" class="block py-2 hover:bg-gray-700 rounded">Manage Comments</a></li>
               <li>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" 
            class="w-full text-left py-2 hover:bg-gray-700 rounded">
            Logout
        </button>
    </form>
</li>

            </ul>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-5">
            @yield('content')
        </main>
    </div>
</body>
</html>
