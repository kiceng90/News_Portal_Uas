@extends('layouts.admin')
@section('title', 'Daftar Kunjungan')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Daftar Kunjungan</h1>

<table class="min-w-full bg-white shadow rounded overflow-hidden">
    <thead class="bg-gray-200">
        <tr>
            <th class="py-2 px-4 border-b">Berita</th>
            <th class="py-2 px-4 border-b">IP Address</th>
            <th class="py-2 px-4 border-b">Browser</th>
            <th class="py-2 px-4 border-b">Platform</th>
            <th class="py-2 px-4 border-b">Waktu Kunjung</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($visits as $visit)
            <tr>
                <td class="py-2 px-4 border-b">{{ $visit->news->title ?? '-' }}</td>
                <td class="py-2 px-4 border-b">{{ $visit->ip }}</td>
                <td class="py-2 px-4 border-b">{{ $visit->browser }}</td>
                <td class="py-2 px-4 border-b">{{ $visit->platform }}</td>
                <td class="py-2 px-4 border-b">{{ $visit->visited_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection