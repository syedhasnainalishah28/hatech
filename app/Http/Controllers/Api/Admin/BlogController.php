<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $posts = BlogPost::with(['category', 'author:id,name,avatar'])
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->orderByDesc('created_at')
            ->paginate(15);

        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'nullable|exists:blog_categories,id',
            'excerpt'     => 'nullable|string',
            'body'        => 'required|string',
            'thumbnail'   => 'nullable|string',
            'status'      => 'required|in:draft,published',
            'read_time'   => 'nullable|integer',
        ]);

        $post = BlogPost::create([
            ...$data,
            'author_id'    => $request->user()->id,
            'slug'         => Str::slug($data['title']) . '-' . Str::random(5),
            'published_at' => $data['status'] === 'published' ? now() : null,
        ]);

        return response()->json($post, 201);
    }

    public function show(BlogPost $blogPost)
    {
        return response()->json($blogPost->load(['category', 'author']));
    }

    public function update(Request $request, int $id)
    {
        $post = BlogPost::findOrFail($id);
        $data = $request->validate([
            'title'       => 'sometimes|string|max:255',
            'category_id' => 'nullable|exists:blog_categories,id',
            'excerpt'     => 'nullable|string',
            'body'        => 'sometimes|string',
            'thumbnail'   => 'nullable|string',
            'status'      => 'sometimes|in:draft,published',
            'read_time'   => 'nullable|integer',
        ]);

        if (isset($data['status']) && $data['status'] === 'published' && !$post->published_at) {
            $data['published_at'] = now();
        }

        if (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']) . '-' . Str::random(5);
        }

        $post->update($data);
        return response()->json($post);
    }

    public function destroy(int $id)
    {
        BlogPost::findOrFail($id)->delete();
        return response()->json(['message' => 'Post deleted successfully.']);
    }

    public function categories()
    {
        return response()->json(BlogCategory::all());
    }
}
