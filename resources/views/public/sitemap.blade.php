<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($staticPages as $page)
    <url>
        <loc>{{ url('/') }}/{{ $page }}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/es') }}/{{ $page }}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    @foreach($trainers as $trainer)
    <url><loc>{{ url('/') }}/trainers/{{ $trainer['slug'] }}</loc><priority>0.7</priority></url>
    <url><loc>{{ url('/es') }}/trainers/{{ $trainer['slug'] }}</loc><priority>0.7</priority></url>
    @endforeach

    @foreach($services as $service)
    <url><loc>{{ url('/') }}/services/{{ $service['slug'] }}</loc><priority>0.7</priority></url>
    <url><loc>{{ url('/es') }}/services/{{ $service['slug'] }}</loc><priority>0.7</priority></url>
    @endforeach
</urlset>
