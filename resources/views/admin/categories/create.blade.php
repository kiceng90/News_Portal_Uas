@extends('layouts.admin')
@section('title', 'Tambah Kategori')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Tambah Kategori Baru</h1>

<form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label for="name" class="block font-medium">Nama Kategori</label>
        <input type="text" name="name" id="name" class="w-full border-gray-300 rounded" required>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
</form>
@endsection