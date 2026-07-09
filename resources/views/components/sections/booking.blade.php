@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<section class="bg-lightGray py-16 md:py-24 px-4 md:px-6 scroll-reveal" x-intersect="$el.classList.add('is-visible')">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-asphaltBlack font-heading text-4xl md:text-6xl text-center uppercase tracking-tighter mb-4 leading-none">
            {{ t('start_your_journey') }}
        </h2>
        <p class="text-gray-500 text-center text-lg mb-16 max-w-2xl mx-auto">
            {{ t('book_a_free_consultation_and_discover_the_perfect_training_p') }}
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-accent p-8 md:p-12 rounded-[30px] text-center group hover:-translate-y-2 transition-transform duration-500">
                <div class="w-16 h-16 rounded-full bg-black/10 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                </div>
                <h3 class="text-black font-heading text-2xl font-black uppercase mb-2">{{ t('call') }}</h3>
                <p class="text-black/60 text-sm">{{ t('speak_with_our_team') }}</p>
                <a href="tel:+19177326520" class="inline-block mt-4 bg-black text-white px-6 py-3 rounded-full font-bold text-xs uppercase tracking-widest hover:scale-105 transition-transform">(917) 732-6520</a>
            </div>
            <div class="bg-white border border-gray-200 p-8 md:p-12 rounded-[30px] text-center shadow-sm group hover:-translate-y-2 hover:border-accent/40 hover:shadow-lg transition-all duration-500">
                <div class="w-16 h-16 rounded-full bg-accent/10 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-accent" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <h3 class="text-asphaltBlack font-heading text-2xl font-black uppercase mb-2">{{ t('visit') }}</h3>
                <p class="text-gray-500 text-sm">{{ t('meet_us_at_the_studio') }}</p>
                <p class="text-gray-400 text-xs mt-4">Manhattan, NYC</p>
            </div>
            <div class="bg-white border border-gray-200 p-8 md:p-12 rounded-[30px] text-center shadow-sm group hover:-translate-y-2 hover:border-accent/40 hover:shadow-lg transition-all duration-500">
                <div class="w-16 h-16 rounded-full bg-accent/10 flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8 text-accent" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                </div>
                <h3 class="text-asphaltBlack font-heading text-2xl font-black uppercase mb-2">{{ t('email') }}</h3>
                <p class="text-gray-500 text-sm">{{ t('send_us_a_message') }}</p>
                <a href="mailto:a1traininggroup@gmail.com" class="text-accent text-xs font-bold uppercase tracking-widest mt-4 inline-block hover:underline">a1traininggroup@gmail.com</a>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="{{ $p }}/contact" class="inline-block bg-accent text-black px-10 py-4 rounded-full font-heading font-bold text-lg uppercase tracking-widest hover:scale-105 transition-transform">
                {{ t('book_now') }}
            </a>
        </div>
    </div>
</section>
