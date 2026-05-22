@php
    $isEs = app()->getLocale() === 'es';
    $localePrefix = $isEs ? '/es' : '';
@endphp
<nav class="fixed top-0 left-0 right-0 z-50 bg-asphaltBlack/90 backdrop-blur-md border-b border-white/5 transition-all duration-300" x-data="{ mobileOpen: false, mobileServicesOpen: false, servicesOpen: false, scrolled: false }"
     @scroll.window="scrolled = window.scrollY > 50"
     @keydown.escape.window="mobileOpen = false">
    <div class="max-w-7xl mx-auto px-4 md:px-6">
        <div class="flex items-center justify-between h-16 md:h-20">
            <a href="{{ $localePrefix ?: '/' }}" class="flex items-center gap-2 shrink-0">
                <img src="/images/logo.avif" alt="A1 Training" class="h-8 md:h-10 w-auto">
            </a>

            <div class="hidden lg:flex items-center gap-8">
                <div class="relative"
                     @mouseenter="servicesOpen = true" @mouseleave="servicesOpen = false">
                    <a href="{{ $localePrefix }}/services" class="text-white/70 hover:text-accent text-xs font-bold uppercase tracking-widest transition-colors py-8">
                        {{ t('nav.services') }}
                    </a>
                    <div x-show="servicesOpen" x-cloak
                         class="absolute top-full left-0 bg-black border border-white/10 rounded-2xl p-6 shadow-2xl min-w-[600px] grid grid-cols-2 gap-4"
                         @mouseenter="servicesOpen = true" @mouseleave="servicesOpen = false">
                        @php $svcs = load_content('services.json'); @endphp
                        @foreach($svcs ?? [] as $s)
                        <a href="{{ $localePrefix }}/services/{{ $s['slug'] }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition-colors group">
                            <div class="w-10 h-10 rounded-full bg-accent/10 flex items-center justify-center shrink-0">
                                <span class="text-accent font-heading font-black text-xs">{{ substr($s['title'] ?? '', 0, 2) }}</span>
                            </div>
                            <div>
                                <span class="text-white text-xs font-bold uppercase tracking-wider group-hover:text-accent transition-colors">{{ $isEs && !empty($s['titleEs']) ? $s['titleEs'] : $s['title'] }}</span>
                                <p class="text-white/30 text-[9px] font-bold uppercase tracking-widest mt-0.5">{{ t('view_pricing_1') }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                <a href="{{ $localePrefix }}/trainers" class="text-white/70 hover:text-accent text-xs font-bold uppercase tracking-widest transition-colors">{{ t('nav.trainers') }}</a>
                <a href="{{ $localePrefix }}/blog" class="text-white/70 hover:text-accent text-xs font-bold uppercase tracking-widest transition-colors">{{ t('nav.blog') }}</a>
                <a href="{{ $localePrefix }}/about" class="text-white/70 hover:text-accent text-xs font-bold uppercase tracking-widest transition-colors">{{ t('nav.about') }}</a>
                <a href="{{ $localePrefix }}/a1-black-member" class="text-white/70 hover:text-accent text-xs font-bold uppercase tracking-widest transition-colors">{{ t('nav.a1black') }}</a>
                <a href="{{ $localePrefix }}/contact" class="text-white/70 hover:text-accent text-xs font-bold uppercase tracking-widest transition-colors">{{ t('nav.contact') }}</a>

                <a href="{{ $isEs ? '/' : '/es' }}" class="bg-white/5 border border-white/10 px-4 py-2 rounded-full text-white/70 hover:text-accent text-[10px] font-bold uppercase tracking-widest transition-all">
                    {{ t('nav.language') }}
                </a>

                <a href="{{ $localePrefix }}/contact" class="bg-accent text-black px-6 py-2.5 rounded-full font-heading font-bold text-xs uppercase tracking-widest hover:bg-accent/90 transition-all">
                    {{ t('free_consult') }}
                </a>
            </div>

            <button class="lg:hidden text-white p-2" @click="mobileOpen = !mobileOpen">
                <svg x-show="!mobileOpen" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileOpen" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
            </button>
        </div>
    </div>

    <div x-show="mobileOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         @click.self="mobileOpen = false"
         class="lg:hidden fixed inset-0 z-[60]"
         style="background: #000; isolation: isolate;">
        <div class="h-screen px-4 py-6 space-y-4 overflow-y-auto" style="background: #000;">
            <div class="flex items-center justify-between mb-6">
                <a href="{{ $localePrefix ?: '/' }}" @click="mobileOpen = false">
                    <img src="/images/logo.avif" alt="A1 Training" class="h-8 w-auto">
                </a>
                <button @click="mobileOpen = false" class="text-white/70 hover:text-accent p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="space-y-2">
                <button @click="mobileServicesOpen = !mobileServicesOpen"
                        class="w-full flex items-center justify-between px-4 py-2 text-white/70 hover:text-accent text-sm font-bold uppercase tracking-widest transition-colors"
                        :aria-expanded="mobileServicesOpen">
                    <span>{{ t('nav.services') }}</span>
                    <svg :class="{ 'rotate-180': mobileServicesOpen }"
                         class="w-4 h-4 transition-transform duration-200"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="mobileServicesOpen"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-1"
                     class="space-y-1 pl-4 border-l border-white/10 ml-4">
                    @php $mobileSvcs = load_content('services.json'); @endphp
                    @foreach($mobileSvcs ?? [] as $ms)
                    <a href="{{ $localePrefix }}/services/{{ $ms['slug'] }}"
                       class="block px-4 py-2 text-white/50 hover:text-accent text-xs font-bold uppercase tracking-widest transition-colors">{{ $isEs && !empty($ms['titleEs']) ? $ms['titleEs'] : $ms['title'] }}</a>
                    @endforeach
                </div>
            </div>
            <div class="border-t border-white/5 pt-4">
                <a href="{{ $localePrefix }}/trainers" class="block px-4 py-2 text-white/70 hover:text-accent text-sm font-bold uppercase tracking-widest transition-colors">{{ t('nav.trainers') }}</a>
                <a href="{{ $localePrefix }}/blog" class="block px-4 py-2 text-white/70 hover:text-accent text-sm font-bold uppercase tracking-widest transition-colors">{{ t('nav.blog') }}</a>
                <a href="{{ $localePrefix }}/about" class="block px-4 py-2 text-white/70 hover:text-accent text-sm font-bold uppercase tracking-widest transition-colors">{{ t('nav.about') }}</a>
                <a href="{{ $localePrefix }}/a1-black-member" class="block px-4 py-2 text-white/70 hover:text-accent text-sm font-bold uppercase tracking-widest transition-colors">{{ t('nav.a1black') }}</a>
                <a href="{{ $localePrefix }}/refer-friends" class="block px-4 py-2 text-white/70 hover:text-accent text-sm font-bold uppercase tracking-widest transition-colors">{{ t('nav.refer') }}</a>
                <a href="{{ $localePrefix }}/reviews" class="block px-4 py-2 text-white/70 hover:text-accent text-sm font-bold uppercase tracking-widest transition-colors">{{ t('nav.reviews') }}</a>
                <a href="{{ $localePrefix }}/contact" class="block px-4 py-2 text-white/70 hover:text-accent text-sm font-bold uppercase tracking-widest transition-colors">{{ t('nav.contact') }}</a>
            </div>
            <div class="pt-4 border-t border-white/5 space-y-3">
                <a href="{{ $isEs ? '/' : '/es' }}" class="block bg-white/5 border border-white/10 px-4 py-3 rounded-full text-white/70 text-xs font-bold uppercase tracking-widest text-center">{{ t('nav.language') }}</a>
                <a href="{{ $localePrefix }}/contact" class="block bg-accent text-black px-4 py-3 rounded-full text-xs font-bold uppercase tracking-widest text-center font-heading">{{ t('free_consult') }}</a>
            </div>
        </div>
    </div>
</nav>
