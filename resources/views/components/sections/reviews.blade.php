@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<section class="py-24 bg-white rounded-[40px] md:rounded-[60px] mx-2 md:mx-0 px-4 md:px-6 scroll-reveal" x-intersect="$el.classList.add('is-visible')">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 bg-black text-white px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest mb-6">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                Google Reviews
            </div>
            <h2 class="text-black text-5xl md:text-6xl font-black tracking-tighter uppercase mb-4 leading-none italic-fix">
                {{ t('home.reviews.title') }}
            </h2>
            <div class="flex items-center justify-center gap-2 mt-4">
                <div class="flex gap-0.5">@for($j=0; $j<5; $j++)<span class="text-accent text-xl">&star;</span>@endfor</div>
                <span class="text-black font-heading text-2xl uppercase tracking-tighter">5.0</span>
                <span class="text-black/40 text-sm font-bold uppercase tracking-widest">· 8 {{ t('reviews') }}</span>
            </div>
        </div>

        @php
        $testimonials = [
            ['name' => 'Sonny Cheng', 'role' => 'Personal Training', 'time' => '6 months ago', 'text' => 'Miguel and the A1 team help get me in shape over the last 2 years. Improved everyday strength, stamina while training safely. Miguel is a wealth of knowledge when it comes to training, body mechanics and nutrition. Highly recommend.'],
            ['name' => 'Alexis D NYC', 'role' => 'Science-Based Coaching', 'time' => '5 months ago', 'text' => 'A1 training is great. The trainers are highly technical, applying a science-based approach to their coaching. From video taping my running form, analyzing inherent muscle weakness, and focusing on form and flexibility, they are helping to make me a better athlete.'],
            ['name' => 'David Brothers', 'role' => 'Personal Training', 'time' => '3 months ago', 'text' => 'Facilities and equipment are first rate and training staff are excellent. Miguel, in particular, trains athletes of all ages and addresses the specific physical needs of each client. Highly recommended.'],
            ['name' => 'bearfwood', 'role' => 'Personal Training', 'time' => '2 months ago', 'text' => 'They help you establish a training system so you can actually maintain it on your own gym time. I trained with them for a month now and I\'ve seen steady growth in my overall fitness and strength.'],
            ['name' => 'T P', 'role' => 'Results Guaranteed', 'time' => '3 months ago', 'text' => 'Incredibly professional team. Results guaranteed! Would highly recommend this team if you\'re looking to get in the best shape of your life. There\'s a program for everyone!'],
            ['name' => 'Deniz Yilmaz', 'role' => 'Facility & Training', 'time' => '6 months ago', 'text' => 'Amazing trainers, very clean facility with every machine one needs. Highly recommend!'],
        ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonials as $t)
            <div class="bg-black p-7 rounded-[28px] group hover:border-accent/40 transition-all border border-white/5 hover:shadow-[0_0_40px_rgba(201,169,110,0.08)] flex flex-col h-full">
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-accent flex items-center justify-center text-black font-heading font-black text-lg uppercase shrink-0">{{ substr($t['name'], 0, 1) }}</div>
                        <div>
                            <p class="font-heading text-white text-sm uppercase tracking-tight leading-none">{{ $t['name'] }}</p>
                            <p class="text-white/30 text-[10px] font-bold uppercase tracking-widest mt-0.5">{{ $t['time'] }}</p>
                        </div>
                    </div>
                    <svg class="w-5 h-5 shrink-0 opacity-60" viewBox="0 0 24 24" fill="none"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                </div>
                <div class="flex gap-0.5 mb-4">@for($j=0; $j<5; $j++)<span class="text-accent text-sm">&star;</span>@endfor</div>
                <p class="text-white/60 font-medium leading-relaxed text-sm flex-1 italic-fix">&ldquo;{{ $t['text'] }}&rdquo;</p>
                <p class="text-accent/60 text-[10px] font-bold uppercase tracking-widest mt-5">{{ $t['role'] }}</p>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ $p }}/reviews" class="text-black/40 font-black uppercase tracking-widest text-[10px] hover:text-accent transition-colors border border-black/10 px-8 py-3 rounded-full inline-block">
                {{ t('see_all_reviews') }}
            </a>
        </div>
    </div>
</section>
