<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminBlogController extends Controller
{
    // --- Categories ---
    public function categoriesIndex()
    {
        $categories = BlogCategory::latest()->paginate(10);
        return view('admin.blog.categories.index', compact('categories'));
    }

    public function categoriesStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_categories,slug',
            'color' => 'nullable|string|max:50'
        ]);

        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        
        BlogCategory::create($data);
        return redirect()->route('admin.blog.categories')->with('success', 'Category created successfully.');
    }

    public function categoriesUpdate(Request $request, $id)
    {
        $category = BlogCategory::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_categories,slug,'.$id,
            'color' => 'nullable|string|max:50'
        ]);

        $category->update($data);
        return redirect()->route('admin.blog.categories')->with('success', 'Category updated successfully.');
    }

    public function categoriesDestroy($id)
    {
        BlogCategory::findOrFail($id)->delete();
        return redirect()->route('admin.blog.categories')->with('success', 'Category deleted successfully.');
    }

    // --- Posts ---
    public function postsIndex()
    {
        $posts = BlogPost::with('category', 'author')->latest()->paginate(10);
        return view('admin.blog.posts.index', compact('posts'));
    }

    public function postsCreate()
    {
        $categories = BlogCategory::all();
        return view('admin.blog.posts.create', compact('categories'));
    }

    public function postsStore(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_posts,slug',
            'category_id' => 'nullable|exists:blog_categories,id',
            'excerpt' => 'nullable|string',
            'body' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
            'read_time' => 'nullable|integer|min:1',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'focus_keyword' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|url|max:255',
            'sidebar_left_show' => 'nullable|boolean',
            'sidebar_right_show' => 'nullable|boolean',
            'sidebar_left_type' => 'required|in:standard,custom',
            'sidebar_right_type' => 'required|in:standard,custom',
            'sidebar_left_content' => 'nullable|string',
            'sidebar_right_content' => 'nullable|string',
        ]);

        $data['sidebar_left_show'] = $request->has('sidebar_left_show');
        $data['sidebar_right_show'] = $request->has('sidebar_right_show');
        $data['slug'] = $data['slug'] ?: Str::slug($data['title']);
        $data['author_id'] = Auth::id();

        if ($data['status'] == 'published') {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('blogs', 'public');
        }

        BlogPost::create($data);
        return redirect()->route('admin.blog.posts')->with('success', 'Blog post created successfully.');
    }

    public function postsEdit($id)
    {
        $post = BlogPost::findOrFail($id);
        $categories = BlogCategory::all();
        return view('admin.blog.posts.edit', compact('post', 'categories'));
    }

    public function postsUpdate(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_posts,slug,'.$id,
            'category_id' => 'nullable|exists:blog_categories,id',
            'excerpt' => 'nullable|string',
            'body' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
            'read_time' => 'nullable|integer|min:1',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'focus_keyword' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|url|max:255',
            'sidebar_left_show' => 'nullable|boolean',
            'sidebar_right_show' => 'nullable|boolean',
            'sidebar_left_type' => 'required|in:standard,custom',
            'sidebar_right_type' => 'required|in:standard,custom',
            'sidebar_left_content' => 'nullable|string',
            'sidebar_right_content' => 'nullable|string',
        ]);

        $data['sidebar_left_show'] = $request->has('sidebar_left_show');
        $data['sidebar_right_show'] = $request->has('sidebar_right_show');

        // Publish toggle handler
        if ($data['status'] == 'published' && !$post->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('blogs', 'public');
        }

        $post->update($data);
        return redirect()->route('admin.blog.posts')->with('success', 'Blog post updated successfully.');
    }

    public function postsDestroy($id)
    {
        $post = BlogPost::findOrFail($id);
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }
        $post->delete();
        return redirect()->route('admin.blog.posts')->with('success', 'Blog post deleted successfully.');
    }
}
