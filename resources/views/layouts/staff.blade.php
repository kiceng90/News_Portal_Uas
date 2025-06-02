<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Staff Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6; 
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #fff0f9; /* Latar belakang pink pastel */
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 10;
            display: flex;
            flex-direction: column;
        }

        .sidebar .logo {
            padding: 1.5rem;
            font-size: 1.25rem;
            font-weight: 600;
            color: #333;
            border-bottom: 1px solid #eee;
        }

        .sidebar nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            flex: 1;
        }

        .sidebar nav li a {
            display: block;
            padding: 12px 18px;
            color: #333;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .sidebar nav li a:hover,
        .sidebar nav li a:focus {
            background-color: #ffe6f0; /* Efek hover soft pink */
        }

        /* Logout Button */
        .logout-form {
            padding: 1rem;
            border-top: 1px solid #eee;
        }

        .logout-button {
            width: 100%;
            text-align: left;
            padding: 10px 18px;
            background: none;
            border: none;
            color: #d94797;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.2s ease;
        }

        .logout-button:hover {
            background-color: #ffe6f0;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 2rem 1.5rem;
            min-height: 100vh;
            background-color: #f9f5ff; /* Latar belakang pink kebiruan */
        }

        /* Alert Success */
        .alert-success {
            background-color: #dcfce7;
            color: #166534;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">News Portal</div>

        <nav>
            <ul>
                <li><a href="{{ route('staff.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('staff.news.index') }}">Berita</a></li>
                <li><a href="{{ route('staff.categories.index') }}">Kategori</a></li>
                <li><a href="{{ route('staff.countries.index') }}">Negara</a></li>
                <li><a href="{{ route('staff.comments.index') }}">Komentar</a></li>
                <li><a href="{{ route('staff.visits.index') }}">Kunjungan</a></li>
                <li><a href="{{ route('staff.shares.index') }}">Bagikan</a></li>
            </ul>
        </nav>

        <!-- Logout Form -->
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>