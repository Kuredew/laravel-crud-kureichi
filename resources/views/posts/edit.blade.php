@extends('layout')

@section('title', 'Edit Posts')
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

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="from group mb-3">
            <label>image</label>
            <input class="form-control"  type="file" name="image">
        </div>

        <div class="from group mb-3">
            <label>Title</label>
            <input class="form-control"  type="text" name="title" value="{{ $post->title }}">
        </div>

        <div class="from group mb-3">
            <label>Content</label>
            <textarea class="form-control" name="content">{{ $post->content }}</textarea>
        </div>
        <div class="from group mb-3">
            <label>Genre</label>
            <select class="form-control" name="genre" id="">
                @foreach ($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->genre }}</option>
                @endforeach
            </select>
        </div>


        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
@endsection