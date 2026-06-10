@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
@if(!empty($crumbs))
<nav class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest mb-6 overflow-x-auto whitespace-nowrap py-2">
    <a href="{{ $p ?: '/' }}" class="text-white/30 hover:text-accent transition-colors">{{ t('home') }}</a>
    @foreach($crumbs as $crumb)
    <svg class="w-3 h-3 text-white/20 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
    @if($crumb['url'] ?? false)
    <a href="{{ $crumb['url'] }}" class="text-white/30 hover:text-accent transition-colors">{{ $crumb['label'] }}</a>
    @else
    <span class="text-accent">{{ $crumb['label'] }}</span>
    @endif
    @endforeach
</nav>
@endif
