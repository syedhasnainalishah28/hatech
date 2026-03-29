<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\SitePage;
use Illuminate\Http\Request;

class SitePageController extends Controller
{
    public function index()
    {
        return response()->json(SitePage::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:site_pages,slug',
            'is_active' => 'boolean',
        ]);

        $page = SitePage::create($validated);

        return response()->json($page, 201);
    }

    public function show(SitePage $sitePage)
    {
        return response()->json($sitePage);
    }

    public function update(Request $request, SitePage $sitePage)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'slug' => 'string|max:255|unique:site_pages,slug,' . $sitePage->id,
            'is_active' => 'boolean',
        ]);

        $sitePage->update($validated);

        return response()->json($sitePage);
    }

    public function destroy(SitePage $sitePage)
    {
        $sitePage->delete();
        return response()->json(null, 204);
    }
}
