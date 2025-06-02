@extends('layouts.app')
@section('title', 'Daftar Berita')

@section('content')
<h2 class="text-2xl font-semibold mb-4">Daftar Berita</h2>

<!-- Filter Kategori -->
<div class="mb-4">
    <label for="category-filter" class="block mb-2">Pilih Kategori:</label>
    <select id="category-filter" class="border rounded p-2 w-full max-w-xs">
        <option value="">Semua Kategori</option>
        @foreach ($categories as $category)
            <option value="{{ route('news.index') }}?category={{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<!-- Grid Berita -->
<div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
    @forelse ($newsList as $news)
        <div class="bg-white p-4 rounded shadow hover:shadow-md transition">
            @if ($news->image)
                <img src="{{ asset('images/'.$news->image) }}" alt="{{ $news->title }}" class="w-full h-40 object-cover mb-2 rounded">
            @endif
            <h3 class="font-bold text-lg">{{ $news->title }}</h3>
            <p class="text-sm text-gray-700">{{ Str::limit($news->short_desc, 100) }}</p>
            <small class="text-gray-500">{{ $news->created_at->format('d M Y') }}</small>
            <br>
            <a href="{{ route('news.show', $news->id) }}" class="text-blue-600 mt-2 inline-block">Lihat Detail →</a>
        </div>
    @empty
        <p>Tidak ada berita ditemukan.</p>
    @endforelse
</div>

<script>
    document.getElementById('category-filter').addEventListener('change', function () {
        if (this.value) {
            window.location.href = this.value;
        }
    });
</script>
@endsection