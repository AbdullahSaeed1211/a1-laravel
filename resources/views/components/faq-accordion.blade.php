@php
    $isEs = app()->getLocale() === 'es';
    $faqs = $faqs ?? [];
@endphp
@if(!empty($faqs))
<div class="{{ $sectionClass ?? 'pb-24' }}">
    <div class="max-w-3xl mx-auto">
        <h2 class="{{ $headingClass ?? 'text-white font-heading text-3xl md:text-4xl uppercase tracking-tighter mb-8 text-center' }}">
            {{ $title ?? ($isEs ? 'Preguntas Frecuentes' : 'Frequently Asked Questions') }}
        </h2>
        <div class="space-y-4">
            @foreach($faqs as $i => $faq)
            <div class="{{ $itemClass ?? 'bg-white/5 border border-white/10 rounded-2xl overflow-hidden' }}" x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between p-6 text-left">
                    <span class="text-white font-bold text-sm pr-4">{{ $isEs && !empty($faq['qEs']) ? $faq['qEs'] : $faq['q'] }}</span>
                    <svg class="w-4 h-4 text-accent shrink-0" :class="open ? 'rotate-180' : ''" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                </button>
                <div x-show="open" x-cloak class="px-6 pb-6">
                    <p class="{{ $contentClass ?? 'text-white/40 text-sm leading-relaxed' }}">{{ $isEs && !empty($faq['aEs']) ? $faq['aEs'] : $faq['a'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
