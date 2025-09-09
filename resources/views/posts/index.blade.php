@extends('layout')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@section('content')
    <h1>Posts</h1>

    <a href="{{ route('posts.create') }}">Create New Post</a>

    @if ($message = Session::get('success'))
        <div>{{ $message }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Content</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>
                        @if ($post->image)
                            <img src="{{ asset('storage/images/'. $post->image) }}" alt="image" style="min-height: 150px; max-height: 150px;">
                        @endif
                    </td>
                    <td>{{ $post->title }} </td>
                    <td>{{ $post->content }} </td>
                    <td>
                        <a href="{{ route('posts.show', $post->id) }}">Show</a>
                        <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn-danger" type="submit">Delete</button>

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>