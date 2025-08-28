@extends('layout')

@section('content')
    <h1>Edit Post</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Title:</label>
        <input type="text" name="title" value="{{ $post->title }}">
        <label>Content:</label>
        <textarea name="content">{{ $post->content }}</textarea>

        <button type="submit">Submit</button>
    </form>
@endsection