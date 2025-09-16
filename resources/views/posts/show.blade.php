@extends('layout')

@section('title', 'Show Posts')
@section('content')
    @if ($post->image)
        <img src="{{ asset('storage/images/'. $post->image) }}" alt="image" style="min-height: 150px; max-height: 150px;">
    @endif
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    <a href="{{ route('posts.index') }}">Back to list</a>
@endsection
