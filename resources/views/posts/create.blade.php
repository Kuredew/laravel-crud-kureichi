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

    <form action="{{route('posts.store') }}" method="POST">
        @csrf
        <label>Title:</label>
        <input type="text" name="title" value="{{ old('title') }}">

        <label>Content:</label>
        <textarea name="content">{{ old('content') }}</textarea>

        <button type="submit">Submit</button>
    </form>
@endsection