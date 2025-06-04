<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - News Portal</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f5ff; /* Latar belakang netral pink kebiruan */ 
            color: #333;
            line-height: 1.6;
        }

        header {
            background: linear-gradient(90deg, #f9f5ff, #e6f7ff);
            color: #333;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-link {
            color: #333;
            text-decoration: none;
            font-weight: 500;
        }

        .nav-link:hover {
            text-decoration: underline;
        }

        .user-info {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .user-info span {
            font-size: 0.9rem;
            color: #555;
        }

        .logout-button {
            background: none;
            border: none;
            color: #7873f5;
            cursor: pointer;
            font-weight: 500;
        }

        main {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        footer {
            background: #f9f5ff;
            color: #555;
            padding: 1rem;
            text-align: center;
            border-top: 1px solid #eee;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<!-- Header -->
<header class="text-black shadow">
    <div class="logo">News Portal</div>

    <nav class="nav-links">
        <a href="{{ route('news.index') }}" class="nav-link">Beranda</a>
        @auth
            <div class="user-info">
                <span>Halo, {{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-button">Logout</button>
                </form>
            </div>
        @else
            <a href="{{ route('login') }}" class="nav-link">Login</a>
        @endauth
    </nav>
</header>

<!-- Main Content -->
<main>
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">{{ session('success') }}</div>
    @endif

    @yield('content')

    @stack('scripts') <!-- Penting! -->
</main>

<!-- Footer -->
<footer>
    &copy; {{ date('Y') }} News Portal
</footer>

</body>
</html>