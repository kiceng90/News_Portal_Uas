@extends('layouts.app')
@section('title', 'Dashboard Client')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Selamat datang, {{ auth()->user()->name }}!</h1>
    <p>Anda sedang login sebagai <strong>{{ auth()->user()->role }}</strong>.</p>

    <div class="mt-6">
        <a href="{{ route('news.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Lihat Berita</a>
    </div>
</div>
@endsection