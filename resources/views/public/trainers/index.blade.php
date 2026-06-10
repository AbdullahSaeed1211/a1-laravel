@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<x-layouts.public :meta="$meta ?? []">
    <section class="py-24 md:py-32 px-4 relative overflow-hidden pt-36">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-accent/5 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="max-w-7xl mx-auto relative z-10">
            <x-breadcrumbs :crumbs="[['label' => t('nav.trainers')]]" />
            <h1 class="text-white font-heading text-4xl sm:text-5xl md:text-7xl lg:text-8xl tracking-tighter uppercase mb-6 leading-[1.1]">
                {{ t('trainers.hero.title') }} <span class="text-accent italic inline-block py-1">A1</span>
            </h1>
            <p class="text-white/40 text-lg md:text-xl font-medium max-w-2xl leading-relaxed italic">{{ t('trainers.hero.subtitle') }}</p>
        </div>
    </section>

    <section class="px-4 md:px-6 pb-24">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($trainers as $idx => $trainer)
            @php
                $slug = $trainer['slug'] ?? '';
                $localImg = '/images/trainers/' . $slug . '.webp';
                $img = file_exists(public_path($localImg)) ? $localImg : ($trainer['image'] ?? 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=800&h=1000&fit=crop');
            @endphp
            <a href="{{ $p }}/trainers/{{ $slug }}"
               class="{{ $idx === 0 ? 'lg:col-span-2 lg:row-span-2' : '' }} group relative rounded-[40px] overflow-hidden border border-white/5 hover:border-accent/40 transition-all duration-700 aspect-4/5 lg:aspect-auto block shadow-2xl">
                <img src="{{ $img }}" alt="{{ $trainer['name'] }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-1000">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
                <div class="absolute bottom-8 left-8 right-8 z-10">
                    <span class="text-accent font-black uppercase text-[10px] tracking-widest block mb-2">{{ $isEs && !empty($trainer['titleEs']) ? $trainer['titleEs'] : $trainer['title'] }}</span>
                    <h4 class="text-white text-3xl md:text-4xl font-black tracking-tighter uppercase mb-3 leading-none italic italic-fix group-hover:accent-text-gradient transition-all">{{ $trainer['name'] }}</h4>
                    <p class="text-white/60 font-medium text-xs md:text-sm leading-relaxed max-w-xs opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0">{{ $trainer['bio'] ?? ($isEs && !empty($trainer['bioEs']) ? $trainer['bioEs'] : '') }}</p>
                    <div class="mt-6 flex items-center gap-3 opacity-0 group-hover:opacity-100 transition-all delay-100 translate-y-2 group-hover:translate-y-0">
                        <div class="w-10 h-10 rounded-full bg-accent flex items-center justify-center text-black">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </div>
                        <span class="text-white font-black text-[10px] uppercase tracking-widest">{{ t('trainers.view_profile') }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    <x-faq-accordion :faqs="load_faq('trainers')" title="{{ $isEs ? 'Preguntas Frecuentes' : 'FAQs' }}" />

    <x-sections.cta />
</x-layouts.public>
