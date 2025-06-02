@extends('layouts.app')
@section('title', $news->title)

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-3xl font-bold mb-2">{{ $news->title }}</h1>
    <small class="text-gray-500 mb-4 block">{{ $news->created_at->format('d M Y') }}</small>

    @if ($news->image)
        <img src="{{ asset('images/'.$news->image) }}" alt="{{ $news->title }}" class="w-full h-64 object-cover mb-4 rounded">
    @endif

    <p class="whitespace-pre-line">{!! nl2br(e($news->content)) !!}</p>

    <hr class="my-4">

    <a href="{{ route('news.index') }}" class="text-blue-600">&laquo; Kembali ke Daftar Berita</a>
</div>
@endsection