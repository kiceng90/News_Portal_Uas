@extends('layouts.staff')
@section('title', 'Daftar Share')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Daftar Berita yang Dibagikan</h1>

<table class="min-w-full bg-white shadow rounded overflow-hidden">
    <thead class="bg-gray-200">
        <tr>
            <th class="py-2 px-4 border-b">Berita</th>
            <th class="py-2 px-4 border-b">Platform</th>
            <th class="py-2 px-4 border-b">Browser</th>
            <th class="py-2 px-4 border-b">Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($shares as $share)
            <tr>
                <td class="py-2 px-4 border-b">{{ $share->news->title ?? '-' }}</td>
                <td class="py-2 px-4 border-b">{{ ucfirst($share->platform) }}</td>
                <td class="py-2 px-4 border-b">{{ $share->browser }}</td>
                <td class="py-2 px-4 border-b">{{ $share->created_at->format('d M Y H:i') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection