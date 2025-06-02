@extends('layouts.admin')
@section('title', 'Tambah Berita')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Tambah Berita Baru</h1>

<form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf

    <div>
        <label for="title" class="block font-medium">Judul</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full border-gray-300 rounded" required>
    </div>

    <div>
        <label for="short_desc" class="block font-medium">Deskripsi Singkat</label>
        <textarea name="short_desc" id="short_desc" rows="3" class="w-full border-gray-300 rounded" required>{{ old('short_desc') }}</textarea>
    </div>

    <div>
        <label for="content" class="block font-medium">Isi Berita</label>
        <textarea name="content" id="content" rows="5" class="w-full border-gray-300 rounded" required>{{ old('content') }}</textarea>
    </div>

    <div>
        <label for="author" class="block font-medium">Penulis</label>
        <input type="text" name="author" id="author" value="{{ old('author') }}" class="w-full border-gray-300 rounded" required>
    </div>

    <div>
        <label for="slug" class="block font-medium">Slug</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="w-full border-gray-300 rounded" required>
    </div>

    <div>
        <label for="category_id" class="block font-medium">Kategori</label>
        <select name="category_id" id="category_id" class="w-full border-gray-300 rounded" required>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="country_id" class="block font-medium">Negara</label>
        <select name="country_id" id="country_id" class="w-full border-gray-300 rounded" required>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->country_name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="image" class="block font-medium">Gambar</label>
        <input type="file" name="image" id="image" class="w-full border-gray-300 rounded">
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
</form>
@endsection