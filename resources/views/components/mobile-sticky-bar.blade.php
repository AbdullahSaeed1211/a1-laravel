@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<div class="fixed bottom-0 left-0 right-0 z-50 bg-asphaltBlack/95 backdrop-blur-md border-t border-white/5 lg:hidden pb-[env(safe-area-inset-bottom)]">
    <div class="flex items-center justify-around py-3 px-2">
        <a href="{{ $p ?: '/' }}" class="flex flex-col items-center gap-1 text-white/40 hover:text-accent transition-colors">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
            <span class="text-[8px] font-bold uppercase tracking-widest">Home</span>
        </a>
        <a href="{{ $p }}/services" class="flex flex-col items-center gap-1 text-white/40 hover:text-accent transition-colors">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
            <span class="text-[8px] font-bold uppercase tracking-widest">{{ t('services') }}</span>
        </a>
        <a href="{{ $p }}/reviews" class="flex flex-col items-center gap-1 text-white/40 hover:text-accent transition-colors">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            <span class="text-[8px] font-bold uppercase tracking-widest">{{ t('reviews_1') }}</span>
        </a>
        <a href="{{ $p }}/contact" class="flex items-center gap-1.5 bg-accent text-black px-4 py-2 rounded-full">
            <span class="text-[8px] font-bold uppercase tracking-widest">{{ t('free_consult') }}</span>
        </a>
    </div>
</div>
