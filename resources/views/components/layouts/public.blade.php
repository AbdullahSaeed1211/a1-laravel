<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="p:domain_verify" content="b4dbf21423cd42a8c22a9456e84f059b"/>
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
    @if(!request()->routeIs('calendar', 'es.calendar', 'contact', 'es.contact'))
        <x-lead-popup />
    @endif
    @livewireScripts
    @stack('scripts')
    <script>
    (function () {
        if (window.__mbFallbackArmed) return;
        window.__mbFallbackArmed = true;
        var DIRECT = 'https://go.mindbodyonline.com/book/widgets/appointments/view/3568434ef8f/services';
        var es = document.documentElement.lang === 'es';
        setTimeout(function () {
            document.querySelectorAll('.mindbody-widget').forEach(function (w) {
                if (w.querySelector('iframe')) return;
                var box = document.createElement('div');
                box.style.cssText = 'text-align:center;margin-top:16px;padding:20px;border-radius:16px;background:#fff8ec;border:1px solid #e5c97a;color:#111;';
                box.innerHTML = '<p style="font-weight:800;margin-bottom:12px;">' +
                    (es ? 'No se pudo cargar el horario en vivo (a menudo lo causan bloqueadores de anuncios o ajustes de privacidad).' : 'The live schedule could not be loaded (often caused by ad-blockers or browser privacy settings).') +
                    '</p><a href="' + DIRECT + '" target="_blank" rel="noopener" style="display:inline-block;background:#c9a96e;color:#111;font-weight:800;padding:12px 28px;border-radius:9999px;text-decoration:none;">' +
                    (es ? 'Reservar directamente' : 'Book directly on Mindbody') + '</a>';
                w.parentNode.insertBefore(box, w.nextSibling);
            });
        }, 12000);
    })();
    </script>
</body>
</html>
