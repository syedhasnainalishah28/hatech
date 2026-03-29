<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use App\Models\SitePage;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    // Public: get all active sections for a page
    public function page(string $page)
    {
        $sections = PageSection::where('page', $page)
            ->where('active', true)
            ->pluck('value', 'section_key')
            ->toArray();

        // Check if there's a visual builder page
        $builderPage = SitePage::where('slug', $page)->where('is_published', true)->first();
        
        return response()->json([
            'variables' => $sections,
            'builder' => $builderPage ? [
                'html' => $builderPage->html_content,
                'css' => $builderPage->css_content,
            ] : null
        ]);
    }

    // Admin: list all sections
    public function index()
    {
        return response()->json(PageSection::orderBy('page')->orderBy('section_key')->get());
    }

    // Admin: create/update a section (upsert)
    public function upsert(Request $request)
    {
        $data = $request->validate([
            'page'        => 'required|string',
            'section_key' => 'required|string',
            'type'        => 'in:text,richtext,image,list,json',
            'value'       => 'nullable|string',
            'active'      => 'boolean',
        ]);

        $section = PageSection::updateOrCreate(
            ['page' => $data['page'], 'section_key' => $data['section_key']],
            $data
        );

        return response()->json($section, 201);
    }

    // Admin: delete a section
    public function destroy(int $id)
    {
        PageSection::findOrFail($id)->delete();
        return response()->json(['message' => 'Section deleted.']);
    }
}
