@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<x-layouts.public :meta="$meta ?? []">
    <div class="bg-black min-h-screen">
        <div class="relative w-full h-[55vh] md:h-[65vh] overflow-hidden">
            @if(!empty($blog['coverImage']))
            <img src="{{ $blog['coverImage'] }}" alt="{{ $blog['title'] }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-black/20"></div>
            @endif
            <div class="absolute top-0 left-0 w-full px-4 md:px-8 z-10 pt-24">
                <div class="max-w-4xl mx-auto">
                    <x-breadcrumbs :crumbs="[
                        ['label' => $isEs ? 'Blog' : 'Blog', 'url' => url($p . '/blog')],
                        ['label' => $blog['title']],
                    ]" />
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full px-4 md:px-8 pb-10 z-10">
                <div class="max-w-4xl mx-auto">
                    <span class="bg-accent/20 text-accent text-[10px] font-black uppercase px-3 py-1 rounded-full tracking-widest border border-accent/30 mb-4 inline-block">
                        {{ $isEs && !empty($blog['category_es']) ? $blog['category_es'] : ($blog['category'] ?? 'Wellness') }}
                    </span>
                    <h1 class="text-white font-heading text-3xl sm:text-4xl md:text-6xl tracking-tighter uppercase leading-none mb-4">
                        {{ $isEs && !empty($blog['title_es']) ? $blog['title_es'] : $blog['title'] }}
                    </h1>
                    <div class="flex items-center gap-6 text-white/50 text-xs font-bold uppercase tracking-widest">
                        @if(!empty($blog['author']))<span class="flex items-center gap-1.5">{{ $blog['author'] }}</span>@endif
                        @if(!empty($blog['createdAt']))<span class="flex items-center gap-1.5">{{ \Carbon\Carbon::parse($blog['createdAt'])->format('M d, Y') }}</span>@endif
                    </div>
                </div>
            </div>
        </div>

        <article class="max-w-4xl mx-auto px-4 py-16">
            <div class="prose prose-invert prose-lg max-w-none text-white/70 leading-relaxed space-y-6">
                @php $content = $isEs && !empty($blog['content_es']) ? $blog['content_es'] : ($blog['content'] ?? $blog['excerpt'] ?? ''); @endphp
                @if(preg_match('/^<[a-z!]/', trim($content)))
                    {!! $content !!}
                @else
                @foreach(explode("\n\n", $content) as $para)
                    @php $para = trim($para); @endphp
                    @if(!empty($para))
                        @if(preg_match('/^#{1,3}\s/', $para))
                            @php $level = strpos($para, ' '); $text = substr($para, $level + 1); @endphp
                            <h{{ $level }} class="text-white font-heading text-2xl md:text-3xl uppercase tracking-tighter mt-10 mb-4">{{ $text }}</h{{ $level }}>
                        @elseif(preg_match('/^-\s/', $para))
                            <ul class="list-disc pl-5 space-y-2 text-white/60">
                            @foreach(explode("\n", $para) as $item)
                                @php $item = trim(ltrim($item, '- ')); @endphp
                                @if(!empty($item))<li>{{ $item }}</li>@endif
                            @endforeach
                            </ul>
                        @else
                            <p>{{ $para }}</p>
                        @endif
                    @endif
                @endforeach
                @endif
            </div>
        </article>

        @php
            $allBlogs = load_content('blogs.json');
            $relatedBlogs = array_filter($allBlogs, fn($b) => ($b['category'] ?? '') === ($blog['category'] ?? '') && $b['slug'] !== $blog['slug'] && ($b['published'] ?? false));
            $relatedBlogs = array_slice(array_values($relatedBlogs), 0, 3);
        @endphp

        @php
            $cat = $blog['category'] ?? '';
            $ctaMap = [
                'Strength' => ['slug' => 'personal-training', 'text' => t('train_with_our_strength_experts'), 'es' => 'Entrena con nuestros expertos en fuerza', 'en' => 'Train with our strength experts'],
                'Nutrition' => ['slug' => 'registered-dietitians', 'text' => t('speak_with_a_registered_dietitian'), 'es' => 'Habla con un dietista registrado', 'en' => 'Speak with a registered dietitian'],
                'Recovery' => ['slug' => 'physical-therapy', 'text' => t('book_a_physical_therapy_consult'), 'es' => 'Programa una consulta de terapia física', 'en' => 'Book a physical therapy consult'],
                'Training' => ['slug' => 'personal-training', 'text' => t('start_your_training_journey'), 'es' => 'Comienza tu entrenamiento', 'en' => 'Start your training journey'],
                'Mindset' => ['slug' => 'consultations', 'text' => t('book_a_free_consultation'), 'es' => 'Reserva una consulta gratuita', 'en' => 'Book a free consultation'],
                'Lifestyle' => ['slug' => 'consultations', 'text' => t('transform_your_lifestyle'), 'es' => 'Transforma tu estilo de vida', 'en' => 'Transform your lifestyle'],
            ];
            $cta = $ctaMap[$cat] ?? ['slug' => 'consultations', 'text' => t('start_your_journey_1'), 'en' => 'Start your journey', 'es' => 'Comienza tu viaje'];
        @endphp
        <section class="px-4 pb-8">
            <div class="max-w-3xl mx-auto bg-accent/10 border border-accent/20 rounded-[30px] p-8 text-center">
                <p class="text-white font-heading text-xl font-black uppercase mb-4">{{ t('ready_to_take_action') }}</p>
                <a href="{{ $p }}/services/{{ $cta['slug'] }}" class="inline-block bg-accent text-black px-8 py-4 rounded-full font-heading font-black uppercase tracking-widest text-sm hover:bg-white transition-all">{{ $isEs ? $cta['es'] : $cta['en'] }}</a>
            </div>
        </section>

        @if(!empty($relatedBlogs))
        <section class="px-4 pb-24">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-white font-heading text-3xl md:text-4xl uppercase tracking-tighter mb-8 text-center">{{ t('related_articles') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedBlogs as $rb)
                    <a href="{{ $p }}/blog/{{ $rb['slug'] }}" class="group bg-white/3 border border-white/10 rounded-[30px] overflow-hidden hover:border-accent/40 transition-all">
                        <div class="aspect-16/9 overflow-hidden">
                            <img src="{{ $rb['coverImage'] ?? '/images/training/personal-training-hero.webp' }}" alt="{{ $rb['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        </div>
                        <div class="p-6">
                            <span class="text-accent text-[10px] font-black uppercase tracking-widest">{{ $rb['category'] ?? 'Wellness' }}</span>
                            <h3 class="text-white font-heading text-lg font-black uppercase tracking-tighter mt-2 group-hover:text-accent transition-colors">{{ $isEs && !empty($rb['title_es']) ? $rb['title_es'] : $rb['title'] }}</h3>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <x-sections.cta />
    </div>
</x-layouts.public>
