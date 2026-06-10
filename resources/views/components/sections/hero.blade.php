@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<section class="pt-24 md:pt-32 pb-12 md:pb-20 px-4 bg-black relative overflow-hidden" x-intersect="$el.classList.add('is-visible')">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-[250px] md:w-[500px] h-[250px] md:h-[500px] bg-accent/5 rounded-full blur-[80px] md:blur-[120px]"></div>
        <div class="absolute bottom-1/4 right-1/4 w-[200px] md:w-[400px] h-[200px] md:h-[400px] bg-accent/3 rounded-full blur-[60px] md:blur-[100px]"></div>
    </div>

    <div class="max-w-7xl mx-auto relative z-10">
        <div class="bg-white rounded-t-[30px] md:rounded-t-[40px] px-6 md:px-8 py-4 md:py-6 flex flex-col md:flex-row justify-between items-center gap-4 scroll-reveal">
            <span class="text-black font-black uppercase text-[10px] md:text-sm tracking-widest text-center md:text-left">{{ t('home.hero.tagline') }}</span>
            <div class="flex flex-wrap justify-center gap-3 md:gap-4 text-black/40 text-[9px] md:text-[10px] font-black tracking-widest uppercase">
                <span>01. {{ t('personal') }}</span>
                <span class="text-accent opacity-50">/</span>
                <span>02. {{ t('group') }}</span>
                <span class="text-accent opacity-50">/</span>
                <span>03. {{ t('therapy') }}</span>
            </div>
        </div>

        <div class="bg-white rounded-b-[30px] md:rounded-b-[40px] p-6 md:p-16 grid grid-cols-1 lg:grid-cols-[1.1fr_0.9fr] gap-8 md:gap-12 relative scroll-reveal">
            <div class="relative z-10 flex flex-col justify-center">
                <h1 class="text-black font-heading text-5xl sm:text-6xl md:text-7xl lg:text-[80px] xl:text-[100px] leading-[1.05] tracking-tighter uppercase mb-6 md:mb-10 pt-1">
                    <span class="block">{{ t('home.hero.title') }}</span>
                    <span class="block accent-text-gradient italic">{{ t('home.hero.title_accent') }}</span>
                </h1>

                <div class="flex flex-col md:flex-row items-center gap-8 md:gap-10">
                    <p class="text-black/60 font-semibold max-w-xs text-xs md:text-sm leading-relaxed border-l-4 border-accent pl-4 md:pl-6">
                        {{ t('home.hero.subtitle') }}
                    </p>
                    <a href="{{ $p }}/contact" class="btn-accent w-full md:w-auto px-6 md:px-10 py-3 md:py-4 rounded-full shadow-2xl flex items-center justify-center gap-3 group">
                        <span class="font-heading text-lg md:text-2xl tracking-wide uppercase">{{ t('home.hero.cta') }}</span>
                        <span class="bg-black text-accent w-7 h-7 md:w-8 md:h-8 rounded-full flex items-center justify-center text-sm md:text-base group-hover:translate-x-2 transition-transform duration-300">&rarr;</span>
                    </a>
                </div>

                <div class="flex items-center gap-4 mt-10">
                    <div class="flex -space-x-2">
                        @foreach([1, 2, 3, 4] as $i)
                        <div class="w-8 h-8 rounded-full border-2 border-white overflow-hidden bg-gray-200 ring-2 ring-accent/20">
                            <img src="https://i.pravatar.cc/100?img={{ $i + 10 }}" alt="Client" class="w-full h-full object-cover">
                        </div>
                        @endforeach
                    </div>
                    <div>
                        <div class="flex gap-0.5">@for($s=0; $s<5; $s++)<span class="text-accent text-xs">&star;</span>@endfor</div>
                        <span class="text-black/50 text-[10px] font-bold uppercase tracking-widest">{{ t('home.hero.social_proof') }}</span>
                    </div>
                </div>
            </div>

            <div class="relative mt-8 lg:mt-0">
                <div class="absolute -top-10 md:-top-20 -right-10 md:-right-20 accent-text-gradient opacity-10 text-[100px] md:text-[200px] lg:text-[300px] font-heading leading-none select-none pointer-events-none">A1</div>

                <div class="grid grid-cols-2 gap-4 md:gap-6 relative z-10">
                    <div class="space-y-4 md:space-y-6 pt-6 md:pt-12">
                        <div class="aspect-4/5 rounded-[30px] md:rounded-[40px] overflow-hidden shadow-2xl relative group border-2 md:border-4 border-white">
                            <img src="/images/training/train-at-studio.webp" alt="Elite Training" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="absolute bottom-4 md:bottom-6 left-4 md:left-6 right-4 md:right-6">
                                <span class="bg-black/90 backdrop-blur px-3 md:px-5 py-1.5 md:py-2 rounded-full text-[8px] md:text-[10px] font-black text-accent uppercase tracking-widest border border-accent/30 group-hover:bg-accent group-hover:text-black transition-all duration-300">
                                    {{ t('master_trainer') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4 md:space-y-6">
                        <div class="aspect-3/4 rounded-[30px] md:rounded-[40px] overflow-hidden shadow-2xl relative group border-2 md:border-4 border-white">
                            <img src="/images/training/personal-training-hero.webp" alt="Elite Fitness" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-700">
                            <div class="absolute bottom-4 md:bottom-6 left-4 md:left-6 right-4 md:right-6 bg-accent p-3 md:p-4 rounded-2xl md:rounded-3xl shadow-xl translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                                <p class="text-black text-[8px] md:text-[10px] font-black leading-tight uppercase tracking-tighter">
                                    {{ t('your_goals_are_our_mission_nycs_best_elite_fitness') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 mt-2 md:mt-4 px-3 md:px-4 bg-gray-50 py-2 md:py-3 rounded-full border border-gray-200">
                            <div class="flex -space-x-2 md:-space-x-3">
                                @foreach([1, 2, 3] as $i)
                                <div class="w-6 h-6 md:w-8 md:h-8 rounded-full border-2 border-white overflow-hidden bg-gray-200 ring-2 ring-accent/20">
                                    <img src="https://i.pravatar.cc/100?img={{ $i + 10 }}" alt="User" class="w-full h-full object-cover">
                                </div>
                                @endforeach
                            </div>
                            <span class="text-black/80 font-black text-[8px] md:text-[10px] uppercase tracking-widest">12k+ {{ t('elite') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
