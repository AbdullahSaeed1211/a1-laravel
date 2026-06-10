<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/avif" href="/images/logo.avif">
    <link rel="apple-touch-icon" href="/images/logo.avif">
    <x-seo-meta :meta="$meta ?? []" />
    @if(!empty($meta['jsonld']))
    <script type="application/ld+json">{!! $meta['jsonld'] !!}</script>
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&family=Barlow+Condensed:wght@600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>[x-cloak] { display: none !important; }</style>
    @if(env('GTM_ID'))
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','{{ env("GTM_ID") }}');</script>
    @endif
    @if(env('GA_MEASUREMENT_ID'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GA_MEASUREMENT_ID') }}"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{{ env("GA_MEASUREMENT_ID") }}');</script>
    @endif
</head>
<body class="antialiased min-h-screen flex flex-col font-sans bg-black text-white overflow-x-hidden w-full selection:bg-accent selection:text-asphaltBlack">
    @if(env('GTM_ID'))
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ env('GTM_ID') }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif
    <x-public-navbar />
    <main class="flex-1 pt-16 pb-24 lg:pb-0">{{ $slot }}</main>
    <x-public-footer />
    <x-mobile-sticky-bar />
    <x-lead-popup />
    @livewireScripts
    @stack('scripts')
</body>
</html>
