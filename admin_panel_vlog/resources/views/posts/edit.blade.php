
@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $post->title }}">
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" name="content" id="content">{{ $post->content }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" name="image" id="image">
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid">
            @endif
        </div>

        <div class="form-group">
            <label for="categories">Categories</label>
            <select class="form-control" name="categories[]" id="categories" multiple>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $post->categories->contains($category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="visibility">Visibility</label>
            <select class="form-control" name="visibility" id="visibility">
                @foreach ($visibilityOptions as $value => $label)
                    <option value="{{ $value }}" {{ $post->visibility == $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
@endsection
