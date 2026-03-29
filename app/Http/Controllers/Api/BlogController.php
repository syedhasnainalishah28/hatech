<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    // Public: list published posts
    public function index(Request $request)
    {
        $posts = BlogPost::published()
            ->with(['category:id,name,slug,color', 'author:id,name,avatar'])
            ->when($request->category, fn($q) => $q->whereHas('category', fn($q2) => $q2->where('slug', $request->category)))
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->paginate(12);

        return response()->json($posts);
    }

    // Public: single post
    public function show(string $slug)
    {
        $post = BlogPost::published()
            ->with(['category', 'author:id,name,avatar'])
            ->where('slug', $slug)
            ->firstOrFail();

        return response()->json($post);
    }

    // Public: categories
    public function categories()
    {
        return response()->json(BlogCategory::withCount('posts')->get());
    }

    // Public: submit comment
    public function storeComment(Request $request, int $id)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
            'body'  => 'required|string|max:2000',
        ]);

        $post = BlogPost::findOrFail($id);
        $comment = $post->comments()->create([
            ...$data,
            'user_id'  => $request->user()?->id,
            'approved' => false,
        ]);

        return response()->json(['message' => 'Comment submitted and awaiting moderation.', 'comment' => $comment], 201);
    }

    // Admin: create post
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'nullable|exists:blog_categories,id',
            'excerpt'     => 'nullable|string',
            'body'        => 'required|string',
            'thumbnail'   => 'nullable|string',
            'status'      => 'in:draft,published',
            'read_time'   => 'nullable|integer',
        ]);

        $post = BlogPost::create([
            ...$data,
            'author_id'    => $request->user()->id,
            'slug'         => Str::slug($data['title']),
            'published_at' => ($data['status'] ?? 'draft') === 'published' ? now() : null,
        ]);

        return response()->json($post, 201);
    }

    // Admin: update post
    public function update(Request $request, int $id)
    {
        $post = BlogPost::findOrFail($id);
        $data = $request->validate([
            'title'       => 'sometimes|string|max:255',
            'category_id' => 'nullable|exists:blog_categories,id',
            'excerpt'     => 'nullable|string',
            'body'        => 'sometimes|string',
            'thumbnail'   => 'nullable|string',
            'status'      => 'in:draft,published',
            'read_time'   => 'nullable|integer',
        ]);

        if (isset($data['status']) && $data['status'] === 'published' && !$post->published_at) {
            $data['published_at'] = now();
        }

        $post->update($data);
        return response()->json($post);
    }

    // Admin: delete post
    public function destroy(int $id)
    {
        BlogPost::findOrFail($id)->delete();
        return response()->json(['message' => 'Post deleted.']);
    }
}
