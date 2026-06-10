@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<x-layouts.public :meta="$meta ?? []">
    <section class="py-24 md:py-32 px-4 relative overflow-hidden pt-36">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-accent/5 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="max-w-7xl mx-auto relative z-10">
            <x-breadcrumbs :crumbs="[['label' => t('nav.blog')]]" />
            <h1 class="text-white font-heading text-6xl sm:text-7xl md:text-9xl tracking-tighter uppercase mb-6 leading-[1.1]">{{ t('blog') }} <span class="accent-text-gradient italic inline-block py-1">&amp; Insights</span></h1>
            <p class="text-white/40 text-lg md:text-xl font-medium max-w-2xl leading-relaxed">{{ t('fitness_tips_training_guides_and_wellness_insights_from_our') }}</p>
        </div>
    </section>

    <section class="px-4 md:px-6 pb-24">
        <div class="max-w-7xl mx-auto">
            @if(empty($blogs))
            <div class="text-center py-20 bg-white/5 rounded-3xl border border-white/10">
                <p class="text-white/40 text-lg">{{ $isEs ? 'Aún no hay artículos. ¡Vuelva pronto!' : 'No articles yet. Check back soon!' }}</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($blogs as $blog)
                <a href="{{ $p }}/blog/{{ $blog['slug'] }}" class="group bg-white/5 border border-white/10 rounded-[30px] overflow-hidden hover:border-accent/40 transition-all duration-500 flex flex-col">
                    <div class="relative h-64 overflow-hidden">
                        @if(!empty($blog['coverImage']))
                        <img src="{{ $blog['coverImage'] }}" alt="{{ $blog['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-700">
                        @endif
                        <div class="absolute top-4 left-4 bg-accent text-black text-[10px] font-black uppercase px-3 py-1 rounded-full tracking-widest">
                            {{ $isEs && !empty($blog['category_es']) ? $blog['category_es'] : ($blog['category'] ?? 'Wellness') }}
                        </div>
                    </div>
                    <div class="p-8 flex flex-col grow">
                        <div class="flex items-center gap-4 text-[10px] font-bold text-white/30 uppercase tracking-widest mb-4">
                            @if(!empty($blog['author']))<span>{{ $blog['author'] }}</span>@endif
                            @if(!empty($blog['createdAt']))<span>{{ \Carbon\Carbon::parse($blog['createdAt'])->format('M d, Y') }}</span>@endif
                        </div>
                        <h2 class="text-xl font-heading font-black text-white uppercase leading-tight mb-3 group-hover:text-accent transition-colors">
                            {{ $isEs && !empty($blog['title_es']) ? $blog['title_es'] : $blog['title'] }}
                        </h2>
                        <p class="text-white/40 text-sm leading-relaxed line-clamp-3 mb-6">
                            {{ $isEs && !empty($blog['excerpt_es']) ? $blog['excerpt_es'] : ($blog['excerpt'] ?? '') }}
                        </p>
                        <div class="mt-auto pt-4 border-t border-white/5 flex justify-between items-center">
                            <span class="text-xs font-bold text-white/40 group-hover:text-accent transition-colors uppercase tracking-widest">{{ t('blog.read_more') }}</span>
                            <div class="w-8 h-8 rounded-full bg-accent text-black flex items-center justify-center group-hover:translate-x-1 transition-transform text-sm">&rarr;</div>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-3 text-center py-20">
                    <p class="text-white/30 text-lg">{{ $isEs ? 'No hay artículos todavía.' : 'No articles yet.' }}</p>
                </div>
                @endforelse
            </div>
            @endif
        </div>
    </section>
</x-layouts.public>
