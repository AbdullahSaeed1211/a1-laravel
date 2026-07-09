<title>{{ $meta['title'] ?? 'A1 Training Group' }}</title>
<meta name="description" content="{{ $meta['description'] ?? '' }}">
@if(!empty($meta['keywords']))
<meta name="keywords" content="{{ is_array($meta['keywords']) ? implode(', ', $meta['keywords']) : $meta['keywords'] }}">
@endif
<meta name="robots" content="{{ $meta['robots'] ?? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' }}">
<link rel="canonical" href="{{ $meta['canonical'] ?? url()->current() }}">
@if(!empty($meta['hreflang']))
@foreach($meta['hreflang'] as $locale => $url)
<link rel="alternate" hreflang="{{ $locale }}" href="{{ $url }}">
@endforeach
@endif
<meta property="og:site_name" content="{{ $meta['ogSiteName'] ?? 'A1 Training Group' }}">
<meta property="og:locale" content="{{ $meta['ogLocale'] ?? (app()->getLocale() === 'es' ? 'es_US' : 'en_US') }}">
<meta property="og:type" content="{{ $meta['ogType'] ?? 'website' }}">
<meta property="og:title" content="{{ $meta['ogTitle'] ?? $meta['title'] ?? '' }}">
<meta property="og:description" content="{{ $meta['ogDescription'] ?? $meta['description'] ?? '' }}">
<meta property="og:url" content="{{ $meta['canonical'] ?? url()->current() }}">
<meta property="og:image" content="{{ $meta['ogImage'] ?? '' }}">
@if(!empty($meta['ogImage']))
<meta property="og:image:width" content="{{ $meta['ogImageWidth'] ?? '1200' }}">
<meta property="og:image:height" content="{{ $meta['ogImageHeight'] ?? '630' }}">
@endif
@if(!empty($meta['ogImageAlt']))
<meta property="og:image:alt" content="{{ $meta['ogImageAlt'] }}">
@endif
<meta name="twitter:card" content="{{ $meta['twitterCard'] ?? 'summary_large_image' }}">
<meta name="twitter:title" content="{{ $meta['twitterTitle'] ?? $meta['title'] ?? '' }}">
<meta name="twitter:description" content="{{ $meta['twitterDescription'] ?? $meta['description'] ?? '' }}">
@if(!empty($meta['twitterImage'] ?? $meta['ogImage'] ?? ''))
<meta name="twitter:image" content="{{ $meta['twitterImage'] ?? $meta['ogImage'] ?? '' }}">
@endif
