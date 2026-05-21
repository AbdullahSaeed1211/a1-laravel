@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<section class="py-24 px-4 md:px-6 scroll-reveal" x-intersect="$el.classList.add('is-visible')">
    <div class="max-w-4xl mx-auto bg-accent p-8 md:p-16 rounded-[40px] text-center border-4 md:border-8 border-black relative overflow-hidden group">
        <div class="relative z-10">
            <h2 class="text-black font-heading text-4xl md:text-6xl uppercase tracking-tighter leading-none mb-6">
                {{ t('home.cta.title') }}
            </h2>
            <a href="{{ $p }}/contact" class="inline-block bg-black text-white px-8 md:px-12 py-4 md:py-6 rounded-full font-heading text-xl md:text-2xl uppercase tracking-widest hover:scale-105 transition-transform">
                {{ t('home.cta.button') }}
            </a>
        </div>
        <div class="absolute -bottom-20 -right-20 text-black/5 text-[200px] md:text-[300px] font-heading leading-none select-none pointer-events-none">A1</div>
    </div>
</section>
