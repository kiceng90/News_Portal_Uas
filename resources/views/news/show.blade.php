@extends('layouts.app')
@section('title', $news->title)

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-3xl font-bold mb-2">{{ $news->title }}</h1>
    <small class="text-gray-500 mb-4 block">Dipublikasikan pada {{ $news->created_at->format('d M Y') }}</small>

    @if ($news->image)
        <img src="{{ asset('images/'.$news->image) }}" alt="Gambar Berita" class="w-full h-64 object-cover mb-4 rounded">
    @endif

    <p class="whitespace-pre-line">{!! nl2br(e($news->content)) !!}</p>

    <hr class="my-6">

    <a href="{{ route('news.index') }}" class="text-blue-600">&laquo; Kembali ke Daftar Berita</a>
</div>

<!-- Bagian Komentar -->
<div class="max-w-3xl mx-auto mt-8">
    <h2 class="text-xl font-semibold mb-4">Komentar Pengguna</h2>

    <!-- Form Tambah Komentar Utama -->
    @auth
        <form action="{{ route('news.comment.store', $news->id) }}" method="POST" class="mb-6">
            @csrf
            <input type="hidden" name="parent_id" value=""> <!-- Jika kosong = komentar utama -->

            <div class="mb-4">
                <label for="comment" class="block font-medium">Tinggalkan Komentar:</label>
                <textarea name="comment" id="comment" rows="3" class="w-full border-gray-300 rounded" required></textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kirim Komentar</button>
        </form>
    @else
        <p class="mb-4"><a href="{{ route('login') }}" class="text-blue-600">Login</a> untuk menulis komentar.</p>
    @endauth

    <!-- Loop Daftar Komentar -->
    @forelse ($comments as $comment)
        <div class="mb-4 p-4 border-l-4 border-blue-400 bg-gray-50 rounded">
            <strong>{{ $comment->user->name }}</strong>
            <p>{{ $comment->comment }}</p>
            <small class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>

            <!-- Tombol Balas -->
            @auth
                <a href="javascript:void(0);" data-reply="{{ $comment->id }}" class="ml-2 text-sm text-green-600 hover:underline">Balas</a>
            @endauth

            <!-- Form Balasan -->
            @auth
                <form action="{{ route('news.comment.store', $news->id) }}" method="POST" id="reply-form-{{ $comment->id }}" class="mt-2 ml-6 hidden">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">

                    <textarea name="comment" rows="2" class="w-full border-gray-300 rounded" placeholder="Tulis balasan..." required></textarea>
                    <button type="submit" class="mt-1 bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Kirim Balasan</button>
                </form>
            @endauth

            <!-- Loop Balasan -->
            @foreach ($comment->replies as $reply)
                <div class="ml-6 mt-2 p-3 border-l-4 border-green-300 bg-white rounded">
                    <strong>{{ $reply->user->name }}</strong>
                    <p>{{ $reply->comment }}</p>
                    <small class="text-gray-500">{{ $reply->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
        </div>
    @empty
        <p>Tidak ada komentar ditemukan. Jadilah yang pertama berkomentar!</p>
    @endforelse
</div>

<!-- Bagian Share Berita -->
<div class="max-w-3xl mx-auto mt-8">
    <h3 class="font-semibold mb-2">Bagikan Berita Ini</h3>
    <div class="flex space-x-2">
        <!-- Facebook -->
        <a href="#"
           onclick="trackShare(event, '{{ url("/news/".$news->id."/share?platform=facebook") }}')"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Facebook</a>

        <!-- WhatsApp -->
        <a href="#"
           onclick="trackShare(event, '{{ url("/news/".$news->id."/share?platform=whatsapp") }}')"
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">WhatsApp</a>

        <!-- Twitter -->
        <a href="#"
           onclick="trackShare(event, '{{ url("/news/".$news->id."/share?platform=twitter") }}')"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-sky-600">Twitter</a>

        <!-- Email -->
        {{-- <a href="mailto:?subject=Berita&body={{ urlencode(url('/news/'.$news->id)) }}"
           class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Email</a> --}}
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Toggle form balas komentar
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-reply]').forEach(button => {
            button.addEventListener('click', function () {
                const parentId = this.getAttribute('data-reply');
                const form = document.getElementById('reply-form-' + parentId);

                if (form) {
                    form.classList.toggle('hidden');
                    form.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    });

    // Track share tanpa reload halaman
    function trackShare(event, shareUrl) {
        event.preventDefault();

        fetch(shareUrl, { method: 'GET' })
            .then(() => window.open(shareUrl, '_blank'))
            .catch(err => console.error('Gagal mencatat share:', err));
    }
</script>
@endpush