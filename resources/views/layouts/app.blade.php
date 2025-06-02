<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - News Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-white shadow p-4">
        <h1 class="text-xl font-bold">News Portal</h1>
        <nav class="mt-2">
            <a href="{{ route('news.index') }}">Beranda</a>
            @auth
                <span> | Halo, {{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </nav>
    </header>

    <main class="p-6">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>

    <footer class="mt-10 p-4 text-center border-t">
        &copy; {{ date('Y') }} News Portal
    </footer>
</body>
</html>