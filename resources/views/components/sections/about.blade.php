@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<section class="py-16 md:py-24 px-4 md:px-6 bg-white rounded-[40px] md:rounded-[60px] mx-2 md:mx-0 scroll-reveal" x-intersect="$el.classList.add('is-visible')">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 md:gap-20 items-center">
        <div class="relative">
            <div class="aspect-square rounded-[30px] md:rounded-[40px] overflow-hidden border-8 md:border-[12px] border-black shadow-2xl group">
                <img src="/images/homepage/about-team.webp" alt="A1 Training" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            </div>
            <div class="absolute -bottom-4 md:-bottom-8 -left-4 md:-left-8 bg-accent p-4 md:p-8 rounded-[24px] md:rounded-[32px] border-4 md:border-8 border-white shadow-xl rotate-[-4deg] hover:rotate-0 transition-transform duration-500">
                <span class="text-black font-heading text-2xl md:text-4xl leading-none block">{{ t('since') }}</span>
                <span class="text-black font-heading text-2xl md:text-4xl leading-none">2012</span>
            </div>
        </div>

        <div class="text-black mt-8 md:mt-0">
            <h2 class="font-heading text-5xl md:text-7xl uppercase tracking-tighter mb-6 md:mb-8 leading-none">
                {{ t('the') }} <span class="text-accent">{{ t('vision') }}</span> {{ t('behind_a1') }}
            </h2>
            <p class="text-base md:text-lg font-medium mb-4 md:mb-6 leading-relaxed">
                {{ t('founded_on_the_principle_that_elite_performance_shouldnt_be') }}
            </p>
            <p class="text-black/60 mb-8 md:mb-10 leading-relaxed text-sm md:text-base">
                {{ t('we_recognized_that_time_is_the_most_valuable_asset_by_removi') }}
            </p>
            <div class="grid grid-cols-2 gap-4 md:gap-8">
                <div>
                    <h4 class="font-heading text-3xl md:text-4xl mb-1">12K+</h4>
                    <p class="text-[8px] md:text-[10px] font-bold uppercase tracking-widest opacity-40">{{ t('lives_transformed') }}</p>
                </div>
                <div>
                    <h4 class="font-heading text-3xl md:text-4xl mb-1">NYC / HAMP</h4>
                    <p class="text-[8px] md:text-[10px] font-bold uppercase tracking-widest opacity-40">{{ t('service_area') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-20 md:py-32 px-4 md:px-6">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-white font-heading text-5xl md:text-6xl text-center uppercase tracking-tighter mb-12 md:mb-20 leading-none">
            {{ t('our_pillars') }}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-12">
            @php
            $pillars = [
                ['num' => '01', 'title' => t('precision'), 'desc' => t('every_rep_and_every_movement_is_analyzed_for_maximum_efficie')],
                ['num' => '02', 'title' => t('privacy'), 'desc' => t('no_crowds_no_distractions_just_you_and_a_master_professional')],
                ['num' => '03', 'title' => t('performance'), 'desc' => t('we_dont_just_train_we_optimize_we_look_at_nutrition_sleep_an')],
            ];
            @endphp
            @foreach($pillars as $pdata)
            <div class="bg-white/5 border border-white/10 p-8 md:p-12 rounded-[30px] md:rounded-[40px] group hover:border-accent transition-all duration-500 hover:shadow-[0_0_40px_rgba(201,169,110,0.1)]">
                <div class="text-accent font-heading text-3xl md:text-4xl mb-4 md:mb-6 group-hover:scale-110 transition-transform origin-left">{{ $pdata['num'] }}</div>
                <h3 class="text-white font-heading text-3xl md:text-4xl mb-3 md:mb-4 uppercase leading-none">{{ $pdata['title'] }}</h3>
                <p class="text-white/40 leading-relaxed text-sm md:text-base group-hover:text-white/60 transition-colors">{{ $pdata['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
