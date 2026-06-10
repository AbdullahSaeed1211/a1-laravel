@php $isEs = app()->getLocale() === 'es'; @endphp
<section class="py-24 md:py-32 px-4 md:px-6 scroll-reveal" x-intersect="$el.classList.add('is-visible')">
    <div class="max-w-4xl mx-auto text-center">
        <svg class="w-12 h-12 text-accent/30 mx-auto mb-8" viewBox="0 0 24 24" fill="currentColor"><path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C9.591 11.69 11 13.166 11 15c0 1.933-1.567 3.5-3.5 3.5-1.271 0-2.404-.648-2.917-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C19.591 11.69 21 13.166 21 15c0 1.933-1.567 3.5-3.5 3.5-1.271 0-2.404-.648-2.917-1.179z"/></svg>
        <blockquote class="text-white/60 text-2xl md:text-3xl font-heading italic leading-relaxed">
            &ldquo;{{ t('the_body_achieves_what_the_mind_believes') }}&rdquo;
        </blockquote>
        <p class="text-accent font-black uppercase tracking-widest text-xs mt-8">&mdash; A1 Training Group</p>
    </div>
</section>
