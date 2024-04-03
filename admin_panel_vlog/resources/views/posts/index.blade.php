
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>

    <style>
        /* CSS styles go here */
        .card {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .card-header {
            padding: 10px 15px;
            background-color: #f5f5f5;
            border-bottom: 1px solid #ddd;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .card-body {
            padding: 15px;
        }

        .card-footer {
            padding: 10px 15px;
            background-color: #f5f5f5;
            border-top: 1px solid #ddd;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .card-footer strong {
            font-weight: bold;
        }

        .card-footer span {
            margin-right: 5px;
        }
    </style>
</head>
<body>
<div>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
</div>

@foreach ($posts as $post)
    <div class="card mb-3">
        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
        <div class="card-header">
            {{ $post->title }}
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
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
        </form>

    </div>
@endforeach
</body>
</html>
