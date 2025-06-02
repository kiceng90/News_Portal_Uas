@extends('layouts.admin')
@section('title', 'Daftar Berita')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Daftar Berita</h1>
<a href="{{ route('admin.news.create') }}" class="inline-block mb-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Berita</a>

<table class="min-w-full bg-white shadow rounded overflow-hidden">
    <thead class="bg-gray-200">
        <tr>
            <th class="py-2 px-4 border-b">Judul</th>
            <th class="py-2 px-4 border-b">Kategori</th>
            <th class="py-2 px-4 border-b">Negara</th>
            <th class="py-2 px-4 border-b">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($news as $item)
            <tr>
                <td class="py-2 px-4 border-b">{{ $item->title }}</td>
                <td class="py-2 px-4 border-b">{{ $item->category->name ?? '-' }}</td>
                <td class="py-2 px-4 border-b">{{ $item->country->country_name ?? '-' }}</td>
                <td class="py-2 px-4 border-b">
                    <a href="{{ route('admin.news.edit', $item->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    |
                    <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection