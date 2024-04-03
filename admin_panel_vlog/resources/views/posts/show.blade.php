
@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    @if ($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid">
    @endif
    <div>
        <strong>Categories:</strong>
        @foreach ($post->categories as $category)
            {{ $category->name }}
            @if (!$loop->last)
                ,
            @endif
        @endforeach
    </div>
    <div>
        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
        </form>
    </div>
@endsection
