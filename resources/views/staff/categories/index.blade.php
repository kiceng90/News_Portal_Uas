@extends('layouts.staff')
@section('title', 'Daftar Kategori')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Daftar Kategori</h1>
<a href="{{ route('staff.categories.create') }}" class="inline-block mb-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Kategori</a>

<table class="min-w-full bg-white shadow rounded overflow-hidden">
    <thead class="bg-gray-200">
        <tr>
            <th class="py-2 px-4 border-b">Nama Kategori</th>
            <th class="py-2 px-4 border-b">Status</th>
            <th class="py-2 px-4 border-b">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $cat)
            <tr>
                <td class="py-2 px-4 border-b">{{ $cat->name }}</td>
                <td class="py-2 px-4 border-b">{{ ucfirst($cat->status) }}</td>
                <td class="py-2 px-4 border-b">
                    <a href="{{ route('staff.categories.edit', $cat->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    |
                    <form action="{{ route('staff.categories.destroy', $cat->id) }}" method="POST" class="inline">
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