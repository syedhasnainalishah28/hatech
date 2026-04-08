{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <!-- Static Master Pages -->
    <url>
        <loc>@php echo url('/'); @endphp</loc>
        <lastmod>@php echo now()->toAtomString(); @endphp</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>@php echo url('/services'); @endphp</loc>
        <lastmod>@php echo now()->toAtomString(); @endphp</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>@php echo url('/work'); @endphp</loc>
        <lastmod>@php echo now()->toAtomString(); @endphp</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>@php echo url('/blogs'); @endphp</loc>
        <lastmod>@php echo now()->toAtomString(); @endphp</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>@php echo url('/about'); @endphp</loc>
        <lastmod>@php echo now()->toAtomString(); @endphp</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>@php echo url('/team'); @endphp</loc>
        <lastmod>@php echo now()->toAtomString(); @endphp</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>@php echo url('/contact'); @endphp</loc>
        <lastmod>@php echo now()->toAtomString(); @endphp</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.7</priority>
    </url>

    <!-- Dynamic Portfolio Works -->
    @foreach ($portfolios as $portfolio)
        <url>
            <loc>@php echo url('/work/' . $portfolio->slug); @endphp</loc>
            <lastmod>@php echo $portfolio->updated_at->toAtomString(); @endphp</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    <!-- Dynamic SEO Blog Posts -->
    @foreach ($posts as $post)
        <url>
            <loc>@php echo url('/blogs/' . $post->slug); @endphp</loc>
            <lastmod>@php echo $post->updated_at->toAtomString(); @endphp</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    <!-- Dynamic Team & Authority Profiles -->
    @foreach ($members as $member)
        <url>
            <loc>@php echo url('/team/' . $member->slug); @endphp</loc>
            <lastmod>@php echo $member->updated_at->toAtomString(); @endphp</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
</urlset>
