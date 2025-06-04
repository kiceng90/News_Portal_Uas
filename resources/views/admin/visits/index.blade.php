@extends('layouts.admin')
@section('title', 'Daftar Kunjungan')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Daftar Kunjungan</h1>

<table class="min-w-full bg-white shadow rounded overflow-hidden">
    <thead class="bg-gray-200">
        <tr>
            <th class="py-2 px-4 border-b text-left">Berita</th>
            <th class="py-2 px-4 border-b text-left">IP Address</th>
            <th class="py-2 px-4 border-b text-left">Browser</th>
            <th class="py-2 px-4 border-b text-left">Platform</th>
            <th class="py-2 px-4 border-b text-left">Waktu Kunjung</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($visits as $visit)
            <tr>
                <td class="py-2 px-4 border-b">{{ $visit->news->title ?? '-' }}</td>
                <td class="py-2 px-4 border-b">{{ $visit->ip }}</td>
                <td class="py-2 px-4 border-b">{{ $visit->browser ?? '-' }}</td>
                <td class="py-2 px-4 border-b">{{ $visit->platform ?? '-' }}</td>
                <td class="py-2 px-4 border-b">{{ $visit->created_at->format('d M Y H:i') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center py-4">Belum ada kunjungan ditemukan.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Pagination -->
<div class="mt-6">
    {{ $visits->links() }}
</div>
@endsection