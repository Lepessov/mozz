<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function showAll()
    {
        $posts = Post::paginate(10);

        return view('posts.all', compact('posts'));
    }

    public function index()
    {
        $posts = Post::where('visibility', 'PUBLIC')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        if (Gate::denies('create-post')) {
            abort(403);
        }

        $categories = Category::all();
        $visibilityOptions = ['PUBLIC' => 'Public', 'PRIVATE' => 'Private'];
        return view('posts.create', compact('categories', 'visibilityOptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation rules
        ]);

        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->visibility = $request->input('visibility');
        $post->user_id = auth()->id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/posts', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        $post->categories()->attach($request->input('categories'));

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        if (Gate::denies('update-post', $post)) {
            abort(403);
        }

        $categories = Category::all();
        $visibilityOptions = ['PUBLIC' => 'Public', 'PRIVATE' => 'Private'];
        return view('posts.edit', compact('post', 'categories', 'visibilityOptions'));
    }

    public function update(Request $request, Post $post)
    {
        if (Gate::denies('update-post', $post)) {
            abort(403);
        }

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rule for image
            'categories' => 'array', // Assuming categories are submitted as an array
        ]);

        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->visibility = $request->input('visibility');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/posts', 'public');
            $post->image = $imagePath;
        }

        $post->categories()->sync($validatedData['categories']);

        $post->save();

        return redirect()->route('posts.show', $post->id)->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        if (Gate::denies('delete-post')) {
            abort(403);
        }

        $post->delete();
        return redirect()->route('posts.index');
    }
}
