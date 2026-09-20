{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    @foreach ($seosByType as $type => $seos)
        {!! '<!-- ' . class_basename($type) . ' (' . $seos->count() . ') -->' !!}
        @foreach ($seos as $seo)
            @if ($seo->slug)
    <url>
        <loc>{{ url($seo->slug) }}</loc>
        <lastmod>{{ optional($seo->updated_at)->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
            @endif
        @endforeach
    @endforeach

</urlset>
