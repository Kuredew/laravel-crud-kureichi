@extends('layout')

@section('content')
    <h1>Create Post</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="card-body" action="{{route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="from group mb-3">
            <label>image</label>
            <input class="form-control"  type="file" name="image">
        </div>

        <div class="from group mb-3">
            <label>Title</label>
            <input class="form-control"  type="text" name="title" value="{{ old('title') }}">
        </div>

        <div class="from group mb-3">
            <label>Content</label>
            <textarea class="form-control" name="content">{{ old('content') }}</textarea>
        </div>
        <div class="from group mb-3">
            <label>Genre</label>
            <select class="form-control" name="genre" id="">
                <option value="Romance">Romance</option>
                <option value="Romance">Action</option>
                <option value="Romance">Advanture</option>
                <option value="Romance">Isekai</option>
            </select>
        </div>


        <button type="submit" class="btn-primary">Submit</button>
    </form>
@endsection