<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SitePage;
use Illuminate\Http\Request;

class BuilderController extends Controller
{
    /**
     * Get a page by its slug.
     */
    public function show($slug)
    {
        $page = SitePage::where('slug', $slug)->first();

        if (!$page) {
            return response()->json([
                'html' => '',
                'css' => '',
                'components' => '[]',
                'styles' => '[]',
            ]);
        }

        return response()->json([
            'html' => $page->html_content,
            'css' => $page->css_content,
            'components' => $page->components_json,
            'styles' => $page->styles_json,
        ]);
    }

    /**
     * Save/Update a page.
     */
    public function store(Request $request, $slug)
    {
        $validated = $request->validate([
            'html' => 'nullable|string',
            'css' => 'nullable|string',
            'components' => 'nullable|string', // JSON string from GrapesJS
            'styles' => 'nullable|string',     // JSON string from GrapesJS
            'name' => 'nullable|string'
        ]);

        $page = SitePage::updateOrCreate(
            ['slug' => $slug],
            [
                'name' => $validated['name'] ?? ucfirst($slug),
                'html_content' => $validated['html'] ?? null,
                'css_content' => $validated['css'] ?? null,
                'components_json' => $validated['components'] ?? null,
                'styles_json' => $validated['styles'] ?? null,
            ]
        );

        return response()->json([
            'message' => 'Page saved successfully',
            'page' => $page
        ]);
    }

    /**
     * List all pages available in the builder.
     */
    public function index()
    {
        return response()->json(SitePage::all(['name', 'slug', 'is_published', 'updated_at']));
    }
}
