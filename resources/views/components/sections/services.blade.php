@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<section class="py-24 px-4 md:px-6 scroll-reveal" x-intersect="$el.classList.add('is-visible')">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
            <div class="max-w-2xl">
                <h2 class="text-white text-5xl md:text-7xl font-black tracking-tighter uppercase mb-6 leading-none">
                    {{ t('our_services') }}
                </h2>
                <p class="text-white/40 font-medium text-lg">{{ t('home.services.subtitle') }}</p>
            </div>
            <a href="{{ $p }}/services" class="bg-white/5 border border-white/10 px-8 py-4 rounded-full text-white font-black uppercase tracking-widest text-[10px] hover:bg-accent hover:text-black transition-all">{{ t('common.view_all') }}</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services ?? [] as $idx => $service)
            @php
                $slug = $service['slug'] ?? '';
                $label = $isEs && !empty($service['titleEs']) ? $service['titleEs'] : ($service['title'] ?? '');
                $img = $service['image'] ?? '';
            @endphp
            <a href="{{ $p }}/services/{{ $slug }}"
               class="{{ $idx === 0 ? 'lg:col-span-2 lg:row-span-2 aspect-[4/5] lg:aspect-auto' : 'aspect-[4/5]' }} group relative rounded-[40px] overflow-hidden border border-white/5 hover:border-accent/40 transition-all duration-700 block">
                <img src="{{ $img }}" alt="{{ $label }}" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-1000">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent opacity-90 group-hover:opacity-70 transition-opacity"></div>

                <div class="absolute bottom-8 left-8 right-8 z-10">
                    <h4 class="text-white text-3xl md:text-4xl font-black tracking-tighter uppercase mb-3 leading-none italic italic-fix group-hover:accent-text-gradient transition-all">{{ $label }}</h4>
                    <div class="mt-4 flex items-center gap-3 opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0">
                        <div class="w-10 h-10 rounded-full bg-accent flex items-center justify-center text-black group-hover:scale-110 transition-transform">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </div>
                        <span class="text-white font-black text-[10px] uppercase tracking-widest">{{ t('view_pricing') }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
