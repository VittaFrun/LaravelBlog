<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'slug'         => 'required|string|unique:posts,slug',
            'excerpt'      => 'nullable|string',
            'content'      => 'required|string',
            'image'        => 'nullable|image|max:10240', // Aumento a 10MB
            'img_path_url' => 'nullable|string|max:1000',
            'category_id'  => 'required|exists:categories,id',
            'is_published' => 'nullable',
            'published_at' => 'nullable',
        ]);

        // Asegurar que usemos un ID de usuario válido
        $validated['user_id'] = auth()->id() ?? \App\Models\User::first()?->id ?? 1;
        $validated['is_published'] = $request->has('is_published');
        $validated['published_at'] = $request->published_at ?? now();

        if ($request->filled('img_path_url')) {
            $validated['img_path'] = $request->img_path_url;
        } elseif ($request->hasFile('image')) {
            $validated['img_path'] = $request->file('image')->store('posts', 'public');
        } else {
            $validated['img_path'] = 'posts/default.jpg';
        }

        $post = Post::create($validated);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.posts.index')->with('info', 'Post creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'slug'         => 'required|string|unique:posts,slug,' . $post->id,
            'excerpt'      => 'nullable|string',
            'content'      => 'required|string',
            'image'        => 'nullable|image|max:10240',
            'img_path_url' => 'nullable|string|max:1000',
            'category_id'  => 'required|exists:categories,id',
            'is_published' => 'nullable',
            'published_at' => 'nullable',
        ]);

        $validated['is_published'] = $request->has('is_published');

        if ($request->filled('img_path_url')) {
            // Delete old local image if it exists
            if ($post->img_path && !str_starts_with($post->img_path, 'http') && $post->img_path !== 'posts/default.jpg' && Storage::disk('public')->exists($post->img_path)) {
                Storage::disk('public')->delete($post->img_path);
            }
            $validated['img_path'] = $request->img_path_url;
        } elseif ($request->hasFile('image')) {
            if ($post->img_path && !str_starts_with($post->img_path, 'http') && $post->img_path !== 'posts/default.jpg' && Storage::disk('public')->exists($post->img_path)) {
                Storage::disk('public')->delete($post->img_path);
            }
            $validated['img_path'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($validated);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.index')->with('info', 'Post actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('info', 'La historia se eliminó con éxito');
    }
}
