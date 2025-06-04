@extends('layouts.staff')
@section('title', 'Daftar Share')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Daftar Berita yang Dibagikan</h1>

<table class="min-w-full bg-white shadow rounded overflow-hidden">
    <thead class="bg-gray-200">
        <tr>
            <th class="py-2 px-4 border-b text-left">Judul Berita</th>
            <th class="py-2 px-4 border-b text-left">Platform</th>
            <th class="py-2 px-4 border-b text-left">Browser</th>
            <th class="py-2 px-4 border-b text-left">Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($shares as $share)
            <tr>
                <td class="py-2 px-4 border-b">{{ $share->news->title ?? '-' }}</td>
                <td class="py-2 px-4 border-b">{{ ucfirst($share->platform) }}</td>
                <td class="py-2 px-4 border-b">{{ $share->browser }}</td>
                <td class="py-2 px-4 border-b">{{ $share->created_at->format('d M Y H:i') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center py-4">Belum ada berita yang dibagikan.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $shares->links() }}
@endsection