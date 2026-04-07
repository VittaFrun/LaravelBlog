<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'posts' => \App\Models\Post::with('category', 'user')
            ->where('is_published', true)
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->get()
    ]);
})->name('home');

Route::get('posts/{slug}', function (string $slug) {
    return view('posts.show', [
        'post' => \App\Models\Post::with('category', 'user')->where('slug', $slug)->firstOrFail()
    ]);
})->name('posts.show');

Route::get('dashboard', function () {
    return view('dashboard', [
        'categoryCount' => \App\Models\Category::count(),
        'postCount' => \App\Models\Post::count(),
        'userCount' => \App\Models\User::count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
