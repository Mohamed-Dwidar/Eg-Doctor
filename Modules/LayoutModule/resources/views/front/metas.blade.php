@php
    // If the current URL matches a slug in the seos table, its
    // meta_title/meta_description/meta_tag take priority over
    // whatever $page_meta the calling page passed in. Prefer the
    // already-resolved record SlugResolverController shares (it
    // knows the slug that was actually typed, even for a manual
    // entry that forwards elsewhere and swaps the bound request
    // along the way); fall back to a direct lookup otherwise.
    $__seo = app()->bound('resolved_seo')
        ? app('resolved_seo')
        : \Modules\SeoModule\App\Models\Seo::where('slug', request()->decodedPath())->first();

    if ($__seo) {
        $page_meta['title'] = trim($__seo->meta_title ?? '') ?: ($page_meta['title'] ?? '');
        $page_meta['description'] = trim($__seo->meta_description ?? '') ?: ($page_meta['description'] ?? '');
        $page_meta['keywords'] = trim($__seo->meta_tag ?? '') ?: ($page_meta['keywords'] ?? '');
    }

    $page_meta['title'] = trim($page_meta['title'] ?? '') ?: 'ايجي دكتور | دليلك الطبي للبحث عن أطباء مصر حسب التخصص والمحافظة الاستشارات الطبية';

    $page_meta['description'] = trim($page_meta['description'] ?? '') ?: 'إيجي دكتور دليل طبي شامل يساعدك على البحث عن أفضل الأطباء في مصر حسب التخصص والمحافظة والمنطقة، مع معلومات موثوقة عن الأطباء والعيادات ومقالات واستشارات طبية.';

    $page_meta['keywords'] = trim($page_meta['keywords'] ?? '') ?: 'دليل أطباء مصر, بحث عن طبيب, تخصصات طبية, عيادات, استشارات طبية, إيجي دكتور';

    $page_meta['image'] = trim($page_meta['image'] ?? '') ?: asset('assets/front/img/logo_main.png');
@endphp

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />

<title>{{ $page_meta['title'] }}</title>
<meta name="description" content="{{ $page_meta['description'] }}">
<meta name="keywords" content="{{ $page_meta['keywords'] }}">

<meta property="og:title" content="{{ $page_meta['title'] }}" />
<meta property="og:description" content="{{ $page_meta['description'] }}" />
<meta property="og:image" content="{{ $page_meta['image'] }}" />
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="إيجي دكتور">
<meta property="og:locale" content="ar_EG">

<meta name="robots" content="index, follow" />
<link rel="canonical" href="{{ url()->current() }}" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="format-detection" content="telephone=no" />

<link rel="icon" type="image/png" href="{{ asset('assets/front/img/favicon.png') }}">

{{--
    Several thousand `seos` rows backfilled from the legacy site ended
    up with header_script holding either plain keyword text or a raw
    copy of the record's own content (complete with <br /> tags) —
    a migration bug, not real header scripts. Rendering either raw
    leaks visible text into <head>, which browsers then hoist into
    the top of <body>. A genuine header script is always a <script>
    tag, so require that specifically rather than just "contains a
    '<'" (too loose — content copies have <br /> too). The underlying
    bad data still needs a DB cleanup pass.
--}}
@if ($__seo && $__seo->header_script && stripos($__seo->header_script, '<script') !== false)
    {!! $__seo->header_script !!}
@endif

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-11ZF4Q3D52"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());

gtag('config', 'G-11ZF4Q3D52');
</script>
