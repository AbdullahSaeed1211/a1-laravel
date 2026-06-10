@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<x-layouts.public :meta="$meta ?? []">
    <section class="relative pt-28 pb-20 px-4 overflow-hidden">
        <div class="max-w-5xl mx-auto relative z-10">
            <x-breadcrumbs :crumbs="[
                ['label' => t('services'), 'url' => url($p . '/services')],
                ['label' => $isEs ? $page['titleEs'] : $page['title'],
                 'url' => url($p . '/services/' . $slug)],
                ['label' => $isEs ? $page['headlineEs'] : $page['headline']],
            ]" />
            <h1 class="text-white font-heading text-4xl sm:text-5xl md:text-7xl tracking-tighter uppercase mb-6 leading-none">
                {{ $isEs ? $page['headlineEs'] : $page['headline'] }}
            </h1>
            <p class="text-white/60 text-lg md:text-xl font-medium max-w-3xl leading-relaxed">
                {{ $isEs ? $page['introEs'] : $page['intro'] }}
            </p>
        </div>
    </section>

    @if(!empty($page['sections']))
    <section class="px-4 pb-20">
        <div class="max-w-5xl mx-auto space-y-12">
            @foreach($page['sections'] as $section)
            <div class="bg-white/5 border border-white/10 rounded-[30px] p-8 md:p-12">
                <h2 class="text-white font-heading text-2xl md:text-3xl uppercase tracking-tighter mb-4">{{ $section['heading'] }}</h2>
                <p class="text-white/50 leading-relaxed">{{ $section['content'] }}</p>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    @if(!empty($page['faq']))
    <section class="px-4 pb-20">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-white font-heading text-3xl md:text-4xl uppercase tracking-tighter mb-8 text-center">{{ t('faq') }}</h2>
            <div class="space-y-4">
                @foreach($page['faq'] as $faq)
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6" x-data="{ open: false }">
                    <button @click="open = !open" class="flex justify-between items-center w-full text-left">
                        <span class="text-white font-bold text-sm">{{ $faq['q'] }}</span>
                        <svg class="w-4 h-4 text-accent shrink-0 ml-4" :class="open ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div x-show="open" x-cloak class="mt-4 text-white/40 text-sm leading-relaxed">{{ $faq['a'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @php
        $allServices = load_content('services.json');
        $relatedServices = array_filter($allServices, fn($s) => $s['slug'] !== $slug);
        $relatedServices = array_slice(array_values($relatedServices), 0, 4);
    @endphp
    <section class="px-4 pb-8">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-white font-heading text-2xl md:text-3xl uppercase tracking-tighter mb-6">{{ t('other_services') }}</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($relatedServices as $rs)
                <a href="{{ url($isEs ? '/es/services' : '/services') }}/{{ $rs['slug'] }}" class="bg-white/5 border border-white/10 rounded-[20px] p-5 hover:border-accent/40 transition-all group">
                    <h3 class="text-white font-heading font-black text-sm uppercase group-hover:text-accent">{{ $isEs && !empty($rs['titleEs']) ? $rs['titleEs'] : $rs['title'] }}</h3>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    @if(!empty($page['ctas']))
    <section class="px-4 pb-24">
        <div class="max-w-3xl mx-auto text-center">
            <a href="{{ url($isEs ? '/es/contact' : '/contact') }}" class="inline-block bg-accent text-black px-10 py-4 rounded-full font-heading font-black text-lg uppercase tracking-widest hover:bg-white transition-all">
                {{ $page['ctas'][0] ?? ($isEs ? 'Contáctanos' : 'Contact Us') }}
            </a>
        </div>
    </section>
    @endif
</x-layouts.public>
