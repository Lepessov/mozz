
@extends('layouts.app')

@section('content')
    <div>
        <a href="{{ route('posts.showAll') }}" class="btn btn-primary">View All Posts</a>
        <a href="{{ route('posts.index') }}" class="btn btn-primary">View Only Public Posts</a>
    </div>
    <div class="container">
        @if (auth()->check() && auth()->user()->isAdmin())
            <div class="create-div">
                <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
            </div>
        @endif

        @foreach ($posts as $post)
            <div class="card mb-3">
                <div class="card-header">
                    <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                </div>
                <div class="card-body">
                    <p>{{ $post->content }}</p>
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid">
                    @endif
                </div>
                <div class="card-footer">
                    <strong>Categories:</strong>
                    @foreach ($post->categories as $category)
                        <span>{{ $category->name }}</span>
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </div>
                <div class="card-footer">
                    @if (auth()->check() && auth()->user()->isModerator())
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                    @endif

                    @if (auth()->check() && auth()->user()->isAdmin())
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach

            {{ $posts->links() }}

    </div>
@endsection
