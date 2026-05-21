@php $isEs = app()->getLocale() === 'es'; $p = $isEs ? '/es' : ''; @endphp
<x-layouts.public :meta="$meta ?? []">
    <div class="min-h-screen bg-white pb-20">
        <div class="bg-asphaltBlack text-white py-20 px-4 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-accent/5 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
            <div class="max-w-4xl mx-auto text-center relative z-10">
                <x-breadcrumbs :crumbs="[['label' => t('nav.reviews')]]" />
                <a href="https://g.page/r/CQ8a1srEed1WEBM/review" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-3 mb-6 bg-white/10 px-4 py-2 rounded-full border border-white/20 hover:bg-white/20 transition-all group">
                    <div class="flex items-center">@for($s=0; $s<5; $s++)<svg class="w-4 h-4 fill-accent text-accent" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>@endfor</div>
                    <span class="text-accent text-xs font-bold uppercase tracking-widest group-hover:underline">{{ t('50_google_reviews') }}</span>
                </a>
                <h1 class="text-4xl md:text-6xl font-heading font-black uppercase mb-4">{{ t('what_our_clients_say') }}</h1>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">{{ t('real_results_from_real_people') }}</p>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-2 bg-accent"></div>
        </div>

        @php $allTestimonials = [
            ['name' => 'Sarah M.', 'role' => 'Personal Training Client', 'text' => 'A1 Training completely changed my approach to fitness. Coach Wei made me feel comfortable from day one, and I\'ve lost 30 lbs in 6 months. The in-home sessions fit perfectly into my busy schedule.'],
            ['name' => 'David R.', 'role' => 'Physical Therapy Client', 'text' => 'Dr. Hai Lin is incredible. After my knee surgery, I thought I\'d never run again. His rehab program got me back on my feet — literally. I\'m now running 5Ks pain-free.'],
            ['name' => 'Jennifer L.', 'role' => 'Partner Training Client', 'text' => 'My husband and I do partner training with Coach Kate. It\'s become our favorite activity together. She keeps us both challenged while making sure we\'re having fun.'],
            ['name' => 'Marcus T.', 'role' => 'Boxing Client', 'text' => 'Coach Phillip brings an energy I\'ve never experienced in a gym. The boxing sessions are intense, technical, and incredibly rewarding. Best stress relief in NYC.'],
            ['name' => 'Emily C.', 'role' => 'Post-Natal Client', 'text' => 'Coach Abby helped me rebuild my core after pregnancy. Her knowledge of post-natal fitness is outstanding. I feel stronger now than before I had my baby.'],
            ['name' => 'Robert K.', 'role' => 'Executive Training Client', 'text' => 'As a busy exec, I needed something that fit my schedule. The mobile training is a game-changer. Coach Jamie designs programs that maximize results in minimum time.'],
        ]; @endphp

        <div class="max-w-7xl mx-auto px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($allTestimonials as $t)
                <div class="bg-lightGray rounded-[2rem] p-8 border-2 border-transparent hover:border-accent/30 transition-all flex flex-col">
                    <div class="flex items-center gap-1 mb-4">@for($s=0; $s<5; $s++)<svg class="w-5 h-5 fill-accent text-accent" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>@endfor</div>
                    <svg class="w-8 h-8 text-accent/30 mb-4" viewBox="0 0 24 24" fill="currentColor"><path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C9.591 11.69 11 13.166 11 15c0 1.933-1.567 3.5-3.5 3.5-1.271 0-2.404-.648-2.917-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C19.591 11.69 21 13.166 21 15c0 1.933-1.567 3.5-3.5 3.5-1.271 0-2.404-.648-2.917-1.179z"/></svg>
                    <p class="text-asphaltBlack font-medium leading-relaxed flex-grow italic">&ldquo;{{ $t['text'] }}&rdquo;</p>
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <p class="font-heading font-black text-asphaltBlack uppercase">{{ $t['name'] }}</p>
                        <p class="text-gray-400 text-sm font-medium uppercase">{{ $t['role'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-16 bg-asphaltBlack rounded-[3rem] p-12 text-white text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-80 h-80 bg-accent/5 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-heading font-black uppercase mb-4">{{ t('ready_to_be_next') }}</h2>
                    <a href="{{ $p }}/contact" class="inline-flex items-center gap-3 bg-accent text-asphaltBlack px-8 py-4 rounded-xl font-heading font-black text-xl uppercase hover:bg-yellow-400 transition-all shadow-[0_0_30px_rgba(253,208,82,0.3)] border-b-4 border-asphaltBlack/20">
                        {{ t('book_free_consult') }}
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="max-w-3xl mx-auto px-4 pb-16">
            <x-faq-accordion :faqs="load_faq('reviews')" title="{{ $isEs ? 'Preguntas Frecuentes' : 'Frequently Asked Questions' }}" :headingClass="'text-3xl font-heading font-black uppercase mb-8 text-center text-asphaltBlack'" :itemClass="'bg-lightGray border border-gray-200 rounded-2xl overflow-hidden'" :contentClass="'text-gray-600 leading-relaxed'" />
        </div>
    </div>
</x-layouts.public>
