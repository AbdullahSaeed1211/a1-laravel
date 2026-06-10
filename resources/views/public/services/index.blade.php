@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<x-layouts.public :meta="$meta ?? []">
    <section class="py-24 md:py-32 px-4 relative overflow-hidden pt-36">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-accent/5 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="max-w-7xl mx-auto relative z-10">
            <h1 class="text-white font-heading text-4xl sm:text-5xl md:text-7xl lg:text-8xl tracking-tighter uppercase mb-6 leading-[1.1]">
                {{ t('our') }} <span class="accent-text-gradient italic inline-block py-1">{{ t('services') }}</span>
            </h1>
            <p class="text-white/40 text-lg md:text-xl font-medium max-w-2xl leading-relaxed">{{ t('choose_the_service_option_that_best_fits_your_lifestyle') }}</p>
            <div class="flex items-center gap-4 mt-6">
                <a href="{{ $p }}/trainers" class="text-white/30 hover:text-accent text-[10px] font-bold uppercase tracking-widest transition-colors border border-white/10 px-4 py-2 rounded-full">{{ $isEs ? 'Conoce a los Entrenadores' : 'Meet Our Trainers' }}</a>
                <a href="{{ $p }}/contact" class="text-white/30 hover:text-accent text-[10px] font-bold uppercase tracking-widest transition-colors border border-white/10 px-4 py-2 rounded-full">{{ $isEs ? 'Contáctanos' : 'Book a Consultation' }}</a>
            </div>
        </div>
    </section>

    <section class="px-4 md:px-6 pb-24">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $i => $service)
            <a href="{{ $p }}/services/{{ $service['slug'] }}"
               class="{{ $i === 0 ? 'lg:col-span-2 lg:row-span-2 aspect-4/5 lg:aspect-auto' : 'aspect-4/5' }} group relative rounded-[40px] overflow-hidden border border-white/5 hover:border-accent/40 transition-all duration-700 block shadow-2xl">
                <img src="{{ $service['image'] ?? '' }}" alt="{{ $isEs && !empty($service['titleEs']) ? $service['titleEs'] : $service['title'] }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-1000">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/80 to-black"></div>
                <div class="absolute bottom-8 left-8 right-8 z-10">
                    <h3 class="text-white text-3xl md:text-4xl font-black tracking-tighter uppercase mb-3 leading-tight italic group-hover:text-accent transition-all">
                        {{ $isEs && !empty($service['titleEs']) ? $service['titleEs'] : $service['title'] }}
                    </h3>
                    <p class="text-white/40 text-xs font-medium max-w-xs">{{ $isEs && !empty($service['descriptionEs']) ? $service['descriptionEs'] : ($service['description'] ?? '') }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    <x-faq-accordion :faqs="load_faq('services')" title="{{ $isEs ? 'Preguntas Frecuentes' : 'Frequently Asked Questions' }}" />

    <x-sections.cta />
</x-layouts.public>
