@extends('layouts.app')
@section('title', $news->title)

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-3xl font-bold mb-2">{{ $news->title }}</h1>
    <small class="text-gray-500 mb-4 block">{{ $news->created_at->format('d M Y') }}</small>

    @if ($news->image)
        <img src="{{ asset('images/'.$news->image) }}" alt="Gambar Berita" class="w-full h-64 object-cover mb-4 rounded">
    @endif

    <p class="whitespace-pre-line">{!! nl2br(e($news->content)) !!}</p>

    <hr class="my-4">

    <a href="{{ route('news.index') }}" class="text-blue-600">&laquo; Kembali ke Daftar Berita</a>
</div>

<!-- Bagian Komentar -->
<div class="max-w-3xl mx-auto mt-8">
    <h2 class="text-xl font-semibold mb-4">Komentar Pengguna</h2>

    <!-- Form Komentar Utama -->
    @auth
        <form action="{{ route('news.comment.store', $news->id) }}" method="POST" class="mb-6">
            @csrf
            <div class="mb-4">
                <label for="comment" class="block font-medium">Tinggalkan Komentar:</label>
                <textarea name="comment" id="comment" rows="3" class="w-full border-gray-300 rounded" required></textarea>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kirim Komentar</button>
        </form>
    @else
        <p class="mb-4"><a href="{{ route('login') }}" class="text-blue-600">Login</a> untuk menulis komentar.</p>
    @endauth

    <!-- Daftar Komentar -->
    @forelse ($comments as $comment)
        <div class="mb-4 p-4 border-l-4 border-blue-400 bg-gray-50">
            <strong>{{ $comment->user->name }}</strong>
            <p>{{ $comment->comment }}</p>
            <small class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>

            <!-- Tombol Balas -->
            @auth
                <a href="#reply-form-{{ $comment->id }}" class="text-sm text-green-600 inline-block mt-1">Balas</a>
            @endauth

            <!-- Form Balas Komentar -->
            @auth
                <form action="{{ route('news.comment.store', $news->id) }}" method="POST" id="reply-form-{{ $comment->id }}" class="mt-2 ml-6 hidden">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <textarea name="comment" rows="2" class="w-full border-gray-300 rounded" placeholder="Tulis balasan..." required></textarea>
                    <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded mt-2">Kirim Balasan</button>
                </form>
            @endauth

            <!-- Daftar Balasan -->
            @foreach ($comment->replies as $reply)
                <div class="ml-6 mt-2 p-3 border-l-4 border-green-300 bg-white">
                    <strong>{{ $reply->user->name }}</strong>
                    <p>{{ $reply->comment }}</p>
                    <small class="text-gray-500">{{ $reply->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
        </div>
    @empty
        <p>Tidak ada komentar ditemukan.</p>
    @endforelse
</div>
@push('scripts')
<script>
    document.querySelectorAll('[data-reply]').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const parentId = this.dataset.reply;
            const form = document.getElementById('reply-form-' + parentId);
            form.classList.toggle('hidden');
        });
    });
</script>
@endpush
@endsection