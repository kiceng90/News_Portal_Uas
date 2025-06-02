@extends('layouts.staff')
@section('title', 'Daftar Komentar')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Daftar Komentar</h1>

<table class="min-w-full bg-white shadow rounded overflow-hidden">
    <thead class="bg-gray-200">
        <tr>
            <th class="py-2 px-4 border-b">Berita</th>
            <th class="py-2 px-4 border-b">Pengguna</th>
            <th class="py-2 px-4 border-b">Komentar</th>
            <th class="py-2 px-4 border-b">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($comments as $comment)
            <tr>
                <td class="py-2 px-4 border-b">{{ $comment->news->title ?? '-' }}</td>
                <td class="py-2 px-4 border-b">{{ $comment->user->name ?? '-' }}</td>
                <td class="py-2 px-4 border-b">{{ Str::limit($comment->comment, 50) }}</td>
                <td class="py-2 px-4 border-b">
                    <form action="{{ route('staff.comments.destroy', $comment->id) }}" method="POST" class="inline">
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