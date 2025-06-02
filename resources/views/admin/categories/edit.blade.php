@extends('layouts.admin')
@section('title', 'Edit Kategori')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Edit Kategori</h1>

<form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label for="name" class="block font-medium">Nama Kategori</label>
        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="w-full border-gray-300 rounded" required>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Perbarui</button>
</form>
@endsection