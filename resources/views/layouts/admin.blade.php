<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* CSS untuk sidebar */
        .sidebar {
            width: 250px; /* Lebar sidebar */
            height: 100vh; /* Full tinggi layar */
            position: fixed; /* Tetap di posisi kiri */
            top: 0;
            left: 0;
            background-color: #ffffff;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); /* Efek shadow */
            z-index: 10; /* Pastikan sidebar di atas konten */
        }

        /* CSS untuk konten utama */
        .main-content {
            margin-left: 250px; /* Margin sesuai lebar sidebar */
            padding: 20px;
            min-height: 100vh;
            background-color: #f3f4f6; /* Warna latar belakang */
        }

        /* Hover efek pada menu sidebar */
        .sidebar a {
            display: block;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #e5e7eb;
        }

        /* Logout button */
        .logout-form {
            margin-top: auto; /* Posisi logout di bagian bawah */
            padding: 10px 15px;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="p-4 text-xl font-bold">News Portal</div>
        <nav class="mt-5">
            <ul>
                <li><a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-blue-100">Dashboard</a></li>
                <li><a href="{{ route('admin.news.index') }}" class="block px-4 py-2 hover:bg-blue-100">Berita</a></li>
                <li><a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 hover:bg-blue-100">Kategori</a></li>
                <li><a href="{{ route('admin.countries.index') }}" class="block px-4 py-2 hover:bg-blue-100">Negara</a></li>
                <li><a href="{{ route('admin.comments.index') }}" class="block px-4 py-2 hover:bg-blue-100">Komentar</a></li>
                <li><a href="{{ route('admin.visits.index') }}" class="block px-4 py-2 hover:bg-blue-100">Kunjungan</a></li>
                <li><a href="{{ route('admin.shares.index') }}" class="block px-4 py-2 hover:bg-blue-100">Bagikan</a></li>
            </ul>
        </nav>

        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-red-100">Logout</button>
        </form>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>