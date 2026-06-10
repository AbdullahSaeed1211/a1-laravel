@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<x-layouts.public :meta="$meta ?? []">
    <section class="py-24 md:py-32 px-4 relative overflow-hidden pt-36">
        <div class="max-w-4xl mx-auto relative z-10">
            <h1 class="text-white font-heading text-4xl sm:text-5xl md:text-7xl tracking-tighter uppercase mb-6 leading-[1.1]">
                {{ t('class_schedule') }}
            </h1>
            <p class="text-white/40 text-lg max-w-2xl leading-relaxed mb-8">{{ $isEs
                ? 'A1 Training Group ofrece horarios flexibles que se adaptan a tu estilo de vida. Entrena por la mañana, tarde o noche — en nuestro estudio, en tu casa o virtualmente.'
                : 'A1 Training Group offers flexible scheduling to fit your lifestyle. Train in the morning, afternoon, or evening — at our studio, your home, or virtually.' }}</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                <div class="bg-white/5 border border-white/10 rounded-[30px] p-8 text-center">
                    <div class="w-14 h-14 bg-accent rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-black font-heading text-2xl font-black">AM</span>
                    </div>
                    <h3 class="text-white font-heading text-xl font-black uppercase mb-2">{{ t('morning') }}</h3>
                    <p class="text-white/40 text-sm">{{ t('600_am_1200_pm') }}</p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-[30px] p-8 text-center">
                    <div class="w-14 h-14 bg-accent rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-black font-heading text-2xl font-black">PM</span>
                    </div>
                    <h3 class="text-white font-heading text-xl font-black uppercase mb-2">{{ t('afternoon') }}</h3>
                    <p class="text-white/40 text-sm">{{ t('1200_pm_600_pm') }}</p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-[30px] p-8 text-center">
                    <div class="w-14 h-14 bg-accent rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-black font-heading text-2xl font-black">PM</span>
                    </div>
                    <h3 class="text-white font-heading text-xl font-black uppercase mb-2">{{ t('evening') }}</h3>
                    <p class="text-white/40 text-sm">{{ t('600_pm_900_pm') }}</p>
                </div>
            </div>
            <div class="mt-12 text-center">
                <a href="{{ $p }}/contact" class="inline-block bg-accent text-black px-10 py-4 rounded-full font-heading font-black text-lg uppercase tracking-widest hover:bg-white transition-all">{{ t('book_your_session') }}</a>
            </div>
        </div>
    </section>

    <x-faq-accordion :faqs="load_faq('calendar')" title="{{ $isEs ? 'Preguntas Frecuentes' : 'FAQs' }}" />
</x-layouts.public>
