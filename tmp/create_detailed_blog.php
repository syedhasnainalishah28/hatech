<?php
// Since I'm running this with php artisan tinker, I don't need a full script.
// But some environments might prefer a standalone script.
// I'll just use the tinker approach.
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Str;

$user = User::first();
if (!$user) {
    echo "No user found!\n";
    exit;
}

$category = BlogCategory::updateOrCreate(['slug' => 'gen-z-tech'], [
    'name' => 'Gen Z Tech',
    'color' => '#d4a574'
]);

$post = BlogPost::updateOrCreate(['slug' => 'gen-z-evolution-luxury-tech-soul'], [
    'category_id' => $category->id,
    'author_id' => $user->id,
    'title' => 'Gen Z Evolution: Why Luxury Tech Needs a Soul in 2026',
    'excerpt' => 'Discover why the next generation of high-net-worth individuals is moving beyond simple gadgetry towards deep, soul-infused technological ecosystems.',
    'body' => '<p>In the digital landscape of 2026, the concept of "luxury" has undergone a radical transformation. No longer defined solely by price tags or material scarcity, true luxury in tech is now about **Gen Z Evolution**—a merger of supreme functionality and deep emotional resonance.</p>
<h2>1. The Holographic Shift</h2>
<p>We are no longer satisfied with flat screens. The rise of neural interfaces and holographic workspaces has redefined how we perceive digital assets.</p>
<div class="my-8"><img src="/storage/blogs/ai-neural.png" alt="AI Neural Net" class="rounded-[2rem] shadow-2xl" /></div>
<p>Our recent research at HA Tech indicates that 70% of Gen Z entrepreneurs prefer immersive, spatially-aware environments for productivity over traditional desktop setups. This isn\'t just about cool visuals; it\'s about reducing cognitive load through spatial memory.</p>
<h2>2. Minimalist Efficiency</h2>
<p>Luxury is the absence of noise. Every pixel, Every animation must have a purpose. In our latest enterprise solutions, we\'ve stripped away the clutter to focus on the core "Zero-Latency" experience that modern leaders demand.</p>
<div class="my-8"><img src="/storage/blogs/minimalist-workspace.png" alt="Minimalist Workspace" class="rounded-[2rem] shadow-2xl" /></div>
<p>When you sit at a desk like this, the technology should disappear. It\'s the ultimate paradox of luxury: the more advanced it is, the less you should notice it\'s there until it\'s needed.</p>
<h2>3. The Soul of the Machine</h2>
<p>Finally, we must address the "Soul". In an era of generic AI-generated everything, human intentionality is the new gold standard. HA Tech prides itself on injecting a "Luxury Brutalist" aesthetic—raw, powerful, yet infinitely refined—into everything we build.</p>
<p>It\'s time to stop building gadgets and start building legacies.</p>',
    'thumbnail' => 'blogs/featured-innovation.png',
    'status' => 'published',
    'read_time' => 7,
    'meta_title' => 'Gen Z Tech Evolution & Luxury Ethics 2026',
    'meta_description' => 'A deep dive into how Gen Z is redefining luxury tech through emotional soul and minimalist efficiency. Read the HA Tech insight.',
    'focus_keyword' => 'Gen Z Tech',
    'published_at' => now()
]);

echo "Blog Post Created/Updated: " . $post->id . "\n";
