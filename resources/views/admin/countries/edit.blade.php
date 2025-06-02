@extends('layouts.admin')
@section('title', 'Edit Negara')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Edit Negara</h1>

<form action="{{ route('admin.countries.update', $country->id) }}" method="POST" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label for="country_name" class="block font-medium">Nama Negara</label>
        <input type="text" name="country_name" id="country_name" value="{{ old('country_name', $country->country_name) }}" class="w-full border-gray-300 rounded" required>
    </div>

    <div>
        <label for="status" class="block font-medium">Status</label>
        <select name="status" id="status" class="w-full border-gray-300 rounded">
            <option value="active" {{ $country->status == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $country->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Perbarui</button>
</form>
@endsection