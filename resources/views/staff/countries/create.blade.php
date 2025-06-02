@extends('layouts.staff')
@section('title', 'Tambah Negara')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Tambah Negara Baru</h1>

<form action="{{ route('staff.countries.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label for="country_name" class="block font-medium">Nama Negara</label>
        <input type="text" name="country_name" id="country_name" class="w-full border-gray-300 rounded" required>
    </div>

    <div>
        <label for="status" class="block font-medium">Status</label>
        <select name="status" id="status" class="w-full border-gray-300 rounded">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
</form>
@endsection