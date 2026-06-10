@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<x-layouts.public :meta="$meta ?? []">
    <div class="relative w-full h-[60vh] md:h-[70vh] overflow-hidden">
        <div class="absolute top-0 left-0 w-full px-4 md:px-8 z-10 pt-24">
            <div class="max-w-7xl mx-auto">
                <x-breadcrumbs :crumbs="[
                    ['label' => t('services'), 'url' => url($p . '/services')],
                    ['label' => $isEs && !empty($service['titleEs']) ? $service['titleEs'] : $service['title']],
                ]" />
            </div>
        </div>
        <img src="{{ $service['image'] ?? '' }}" alt="{{ $isEs && !empty($service['titleEs']) ? $service['titleEs'] : $service['title'] }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-black/20"></div>
        <div class="absolute top-0 left-0 w-full px-4 md:px-8 z-10 pt-28">
            <div class="max-w-7xl mx-auto">
                <a href="{{ $p }}/services" class="inline-flex items-center gap-2 text-white/70 hover:text-accent text-xs font-bold uppercase tracking-widest transition-colors bg-black/50 backdrop-blur-sm px-4 py-2 rounded-full border border-white/10">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    {{ t('back_to_services') }}
                </a>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 w-full px-4 md:px-8 pb-10 z-10">
            <div class="max-w-7xl mx-auto">
                <span class="bg-accent/20 text-accent text-[10px] font-black uppercase px-3 py-1 rounded-full tracking-widest border border-accent/30 mb-4 inline-block">{{ $service['category'] ?? '' }}</span>
                <h1 class="text-white font-heading text-4xl sm:text-5xl md:text-7xl tracking-tighter uppercase mb-4 leading-none">{{ $isEs && !empty($service['titleEs']) ? $service['titleEs'] : $service['title'] }}</h1>
                <p class="text-white/60 text-lg md:text-xl font-medium max-w-2xl">{{ $isEs && !empty($service['descriptionEs']) ? $service['descriptionEs'] : ($service['description'] ?? '') }}</p>
            </div>
        </div>
    </div>

    @php $serviceStats = [
        'personal-training' => [['label' => 'Locations', 'value' => 'Gym + Home'], ['label' => 'Session Length', 'value' => '60 min'], ['label' => 'Starting At', 'value' => '$105']],
        'partner-training' => [['label' => 'Per Person', 'value' => 'From $70'], ['label' => 'Session Length', 'value' => '60 min'], ['label' => 'Locations', 'value' => 'Gym + Home']],
        'physical-therapy' => [['label' => 'Credentials', 'value' => 'DPT Level'], ['label' => 'Session Length', 'value' => '60 min'], ['label' => 'Starting At', 'value' => '$235']],
        'massage-therapy' => [['label' => 'Modalities', 'value' => 'Sports + Deep'], ['label' => 'Session Length', 'value' => '60 min'], ['label' => 'Starting At', 'value' => '$180']],
        'kettlebell' => [['label' => 'Format', 'value' => 'Group Class'], ['label' => 'Session Length', 'value' => '45 min'], ['label' => 'Drop-in', 'value' => '$35']],
        'boxing' => [['label' => 'Locations', 'value' => 'Gym + Home'], ['label' => 'Session Length', 'value' => '60 min'], ['label' => 'Starting At', 'value' => '$120']],
        'online-hybrid' => [['label' => 'Format', 'value' => 'Video + App'], ['label' => 'Flexibility', 'value' => '24/7'], ['label' => 'Starting At', 'value' => '$100']],
        'registered-dietitians' => [['label' => 'Format', 'value' => 'Virtual'], ['label' => 'Session Length', 'value' => '60 min'], ['label' => 'Starting At', 'value' => '$150']],
        'consultations' => [['label' => 'Format', 'value' => 'Phone + In-Person'], ['label' => 'Duration', 'value' => '15-60 min'], ['label' => 'Cost', 'value' => 'FREE']],
    ]; @endphp
    @if(!empty($serviceStats[$service['slug']]))
    <div class="bg-accent">
        <div class="max-w-7xl mx-auto px-4 py-4 grid grid-cols-3 divide-x divide-black/20">
            @foreach($serviceStats[$service['slug']] as $stat)
            <div class="text-center px-4 py-2">
                <div class="text-black font-heading text-xl md:text-2xl uppercase tracking-tighter">{{ $stat['value'] }}</div>
                <div class="text-black/60 text-[10px] font-black uppercase tracking-widest">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <section class="max-w-7xl mx-auto px-4 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-16">
            <div class="lg:col-span-3 space-y-12">
                <div>
                    <h2 class="text-white font-heading text-3xl md:text-4xl uppercase tracking-tighter mb-6">{{ t('overview') }}</h2>
                    <p class="text-white/55 leading-[1.85] text-lg">{{ $isEs && !empty($service['longDescriptionEs']) ? $service['longDescriptionEs'] : ($service['longDescription'] ?? '') }}</p>
                </div>

                @if(!empty($service['benefits']))
                <div>
                    <h3 class="text-accent font-heading text-2xl uppercase tracking-tighter mb-6 flex items-center gap-3">
                        <span class="w-8 h-[2px] bg-accent inline-block"></span>
                        {{ t('what_you_get') }}
                    </h3>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach(($isEs && !empty($service['benefitsEs']) ? $service['benefitsEs'] : $service['benefits']) as $benefit)
                        <li class="flex items-start gap-3 bg-white/3 border border-white/8 rounded-2xl p-4">
                            <svg class="w-5 h-5 text-accent mt-0.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            <span class="text-white/70 font-medium text-sm">{{ $benefit }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            @if(!empty($slugPricing) || $service['slug'] === 'consultations')
            <div class="lg:col-span-2">
                <div class="bg-white/4 border border-white/10 rounded-[30px] p-8 sticky top-28 space-y-6">
                    <h3 class="text-accent font-heading text-2xl uppercase tracking-tighter">{{ t('common.pricing') }}</h3>

                    @if(!empty($slugPricing))
                    <div class="space-y-2">
                        @foreach($slugPricing as $plan)
                        <div class="flex justify-between items-center py-3 border-b border-white/5 last:border-0">
                            <div>
                                <span class="text-white font-bold text-sm block">{{ $plan['name'] }}</span>
                                <span class="text-white/30 text-xs">{{ $plan['location'] ?? '' }}</span>
                            </div>
                            <span class="text-accent font-heading font-black text-xl">{{ $plan['price'] == 0 ? 'FREE' : '$'.number_format($plan['price']) }}</span>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-white/30 text-sm">{{ t('pricing_coming_soon') }}</p>
                    @endif

                    <a href="{{ $p }}/contact" class="block w-full bg-accent text-black text-center py-4 rounded-xl font-heading font-black text-lg uppercase hover:bg-accent-light transition-all">{{ t('book_now') }}</a>

                    <div class="pt-2 border-t border-white/5 space-y-2">
                        <div class="flex items-center gap-2 text-white/30 text-xs font-bold uppercase tracking-widest">
                            <svg class="w-3.5 h-3.5 text-accent/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            {{ t('no_contracts') }}
                        </div>
                        <div class="flex items-center gap-2 text-white/30 text-xs font-bold uppercase tracking-widest">
                            <svg class="w-3.5 h-3.5 text-accent/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            {{ t('free_15min_consultation') }}
                        </div>
                        <div class="flex items-center gap-2 text-white/30 text-xs font-bold uppercase tracking-widest">
                            <svg class="w-3.5 h-3.5 text-accent/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            {{ t('manhattan_hamptons') }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>

    @php
        $allServices = load_content('services.json');
        $related = array_filter($allServices, fn($s) => $s['slug'] !== $service['slug'] && $s['category'] === ($service['category'] ?? ''));
        $related = array_slice(array_values($related), 0, 4);
        $faqs = [
            ['q' => 'How do I get started with '.($isEs && !empty($service['titleEs']) ? $service['titleEs'] : $service['title']).'?', 'qEs' => '¿Cómo empiezo con '.($isEs && !empty($service['titleEs']) ? $service['titleEs'] : $service['title']).'?', 'a' => 'Book a free consultation and we\'ll create a personalized plan based on your goals.', 'aEs' => 'Reserva una consulta gratuita y crearemos un plan personalizado basado en tus metas.'],
            ['q' => 'How long are sessions?', 'qEs' => '¿Cuánto duran las sesiones?', 'a' => 'Standard sessions are 45-60 minutes. We recommend 2-3 sessions per week for optimal results.', 'aEs' => 'Las sesiones estándar son de 45 a 60 minutos. Recomendamos 2-3 sesiones por semana para resultados óptimos.'],
            ['q' => 'Can I train at home or at the studio?', 'qEs' => '¿Puedo entrenar en casa o en el estudio?', 'a' => 'Both options are available. Choose what works best for your lifestyle and goals.', 'aEs' => 'Ambas opciones están disponibles. Elige lo que funcione mejor para tu estilo de vida y metas.'],
        ];
    @endphp

    @if(!empty($related))
    <section class="px-4 pb-8">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-white font-heading text-3xl uppercase tracking-tighter mb-8">{{ t('related_services') }}</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($related as $rs)
                <a href="{{ $p }}/services/{{ $rs['slug'] }}" class="bg-white/5 border border-white/10 rounded-[20px] p-6 hover:border-accent/40 transition-all group">
                    <h3 class="text-white font-heading font-black text-lg uppercase group-hover:text-accent">{{ $isEs && !empty($rs['titleEs']) ? $rs['titleEs'] : $rs['title'] }}</h3>
                    <p class="text-white/40 text-xs mt-2">{{ $isEs && !empty($rs['descriptionEs']) ? $rs['descriptionEs'] : ($rs['description'] ?? '') }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section class="px-4 pb-24">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-white font-heading text-3xl md:text-4xl uppercase tracking-tighter mb-8 text-center">{{ t('faqs') }}</h2>
            <div class="space-y-4">
                @foreach($faqs as $i => $faq)
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6" x-data="{ open: false }">
                    <button @click="open = !open" class="flex justify-between items-center w-full text-left">
                        <span class="text-white font-bold text-sm pr-4">{{ $isEs ? $faq['qEs'] : $faq['q'] }}</span>
                        <svg class="w-4 h-4 text-accent shrink-0" :class="open ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div x-show="open" x-cloak class="mt-4 text-white/40 text-sm leading-relaxed">{{ $isEs ? $faq['aEs'] : $faq['a'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-sections.cta />
</x-layouts.public>
