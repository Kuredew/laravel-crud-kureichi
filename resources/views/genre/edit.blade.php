@extends('layout')

@section('title', 'Create Genre')
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

    <form class="card-body" action="{{route('genre.update', $genre->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="from group mb-3">
            <label>Nama Genre</label>
            <input class="form-control"  type="text" name="genre" value="{{ $genre->genre }}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection