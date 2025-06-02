<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow h-screen fixed">
            <div class="p-4 text-xl font-bold">News Portal</div>
            <nav class="mt-5">
                <ul class="space-y-2">
                    <li><a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-blue-100">Dashboard</a></li>
                    <li><a href="{{ route('admin.news.index') }}" class="block px-4 py-2 hover:bg-blue-100">Berita</a></li>
                    <li><a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 hover:bg-blue-100">Kategori</a></li>
                    <li><a href="{{ route('admin.countries.index') }}" class="block px-4 py-2 hover:bg-blue-100">Negara</a></li>
                    <li><a href="{{ route('admin.comments.index') }}" class="block px-4 py-2 hover:bg-blue-100">Komentar</a></li>
                    <li><a href="{{ route('admin.visits.index') }}" class="block px-4 py-2 hover:bg-blue-100">Kunjungan</a></li>
                    <li><a href="{{ route('admin.shares.index') }}" class="block px-4 py-2 hover:bg-blue-100">Bagikan</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-red-100">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="ml-64 p-6 w-full">
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">{{ session('success') }}</div>
            @endif

            @yield('content')
        </div>
    </div>
</body>
</html>